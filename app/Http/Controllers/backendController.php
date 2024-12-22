<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;


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
    
}
