<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;



class BackendController extends Controller
{
    public function adminDashboard()
    {
        return view('backend.index');
    }

    public function adminAddCategory() {
        return view('backend.categories.add');
    }
    
    public function adminStoreCategory(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'order' => 'required|integer',
        ]);
    
        $category = Category::create([
            'name' => $validated['name'],
            'order' => $validated['order'],
        ]);
    
        return response()->json([
            'success' => true,
            'message' => 'Category added successfully',
            'category' => $category,
        ]);
    }

    public function adminViewCategories() {
        return view('backend.categories.view');
    }
    public function adminViewProducts() {
        $products = Product::with('category')->get();  // Charge les produits avec leurs catégories
        return view('backend.products.view', compact('products'));
    }
    
    public function fetchCategories() {
        $categories = Category::all();
        return response()->json([
            'data' => $categories
        ]);
    }

    public function deleteCategory($id) {
        $category = Category::find($id);
    
        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], Response::HTTP_NOT_FOUND);
        }
    
        $category->delete();
    
        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully'
        ]);
    }
    
    public function editCategory($id) {
        $category = Category::find($id);
    
        if (!$category) {
            return redirect()->route('view.categories')->with('error', 'Category not found');
        }
    
        return view('backend.categories.edit_cat', compact('category'));
    }
    
    // Mettre à jour une catégorie
    public function updateCategory(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'order' => 'required|integer',
        ]);
    
        $category = Category::find($id);
    
        if (!$category) {
            return redirect()->route('view.categories')->with('error', 'Category not found');
        }
    
        $category->update([
            'name' => $request->name,
            'order' => $request->order,
        ]);
    
        return redirect()->route('view.categories')->with('success', 'Category updated successfully');
    }

    public function addProduct() {
        $categories = Category::all();
        return view('backend.products.add', compact('categories'));
    }

    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'old_price' => 'nullable|numeric',
            'new_price' => 'nullable|numeric',
            'description' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        // Déterminer si le produit a une promotion
        $hasPromotion = $request->has('has_promotion');
    
        $product = Product::create([
            'category_id' => $validated['category'],
            'name' => $validated['name'],
            'old_price' => $validated['old_price'],
            'new_price' => $hasPromotion ? $validated['new_price'] : null,
            'description' => $validated['description'],
        ]);
    
        // Sauvegarder les images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
    
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                ]);
            }
        }
    
        return redirect()->route('view.products')->with('success', 'Product added successfully!');
    }
    


public function deleteProduct($id)
{
    try {
        $product = Product::findOrFail($id);

        // Vérifier si le produit a des images associées
        if ($product->images()->exists()) {
            foreach ($product->images as $image) {
                // Vérifier si le fichier image existe dans le stockage
                if (Storage::disk('public')->exists($image->image_path)) {
                    Storage::disk('public')->delete($image->image_path);
                }
                // Supprimer l'enregistrement de l'image dans la base de données
                $image->delete();
            }
        }

        // Supprimer le produit
        $product->delete();

        return response()->json(['success' => true, 'message' => 'Product and its images have been deleted successfully.']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Failed to delete product: ' . $e->getMessage()]);
    }
}

    

public function fetchProducts()
{
    $products = Product::with('category')->get(); // Récupère les produits avec leur catégorie
    return response()->json([
        'data' => $products
    ]);
}
public function editProduct($id)
{
    // Récupérer le produit par son ID
    $product = Product::findOrFail($id);
    $categories = Category::all();
    return view('backend.products.edit', compact('product','categories'));
}

public function updateProduct(Request $request, $id)
{
    // Valider les données
    $request->validate([
        'name' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'old_price' => 'required|numeric',
        'new_price' => 'nullable|numeric',
        'description' => 'required|string',
        'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'image_delete.*' => 'nullable|exists:product_images,id',
    ]);

    // Trouver le produit
    $product = Product::findOrFail($id);

    // Mettre à jour les informations
    $product->name = $request->input('name');
    $product->category_id = $request->input('category_id');
    $product->old_price = $request->input('old_price');
    $product->new_price = $request->has('has_promotion') ? $request->input('new_price') : null;
    $product->description = $request->input('description');
    $product->save();

    // Gestion des images existantes
    if ($request->has('image_delete')) {
        foreach ($request->input('image_delete') as $imageId) {
            $image = ProductImage::find($imageId);
            if ($image) {
                Storage::disk('public')->delete($image->image_path);
                $image->delete();
            }
        }
    }

    // Ajouter de nouvelles images
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $imagePath = $image->store('products', 'public');
            $product->images()->create([
                'image_path' => $imagePath,
            ]);
        }
    }

    return redirect()->route('view.products')->with('success', 'Product updated successfully!');
}



public function show($id) {
    $product = Product::with('images', 'category')->findOrFail($id);
    return view('backend.products.show ', compact('product'));
}


    
}
