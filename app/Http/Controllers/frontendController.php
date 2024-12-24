<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Product;

class frontendController extends Controller
{
    public function home(){

         return view('frontend.index');
    }

    public function login(Request $request){
          if($request->isMethod('POST')){
            $check = $request->all();

            if(Auth::guard('web')->attempt(['email'=>$check['email'],'password'=>$check['password']])){
                $user= User::where('email','=',$check['email'])->first();
                    
                if($user->role == 'admin'){
                    Auth::login($user);
                    return response()->json(['data' => 1]);
                }elseif($user->role =='user'){
                    Auth::login($user);
                    return response()->json(['data' => 2]);
                }
                
                }else{
                    return response()->json(['data' => 0]);

                }
          

        }else{
            return redirect()->route('home');
        }

    }

    public function productByCategory($id)
    {
        // Récupérer les produits selon la catégorie et les trier par date
        $products = Product::where('category_id', $id)->latest()->paginate(10);
    
        // Récupérer tous les produits de la catégorie spécifique
        $category = Category::find($id);
    
        // Récupérer toutes les catégories disponibles
        $categories = Category::all();
    
        // Récupérer les prix min et max
        $minPrice = Product::where('category_id', $id)->min('new_price');
        $maxPrice = Product::where('category_id', $id)->max('new_price');
    $produits =Product::all();
        // Calculer les remises pour chaque produit
        $discounts = $products->getCollection()->map(function ($product) {
            if ($product->old_price && $product->new_price && $product->old_price > 0) {
                return (($product->old_price - $product->new_price) * 100) / $product->old_price;
            }
            return 0;
        })->toArray();
    
        // Passer les variables à la vue
        return view('frontend.productsByCategory', compact('products','produits', 'category', 'discounts', 'categories', 'minPrice', 'maxPrice'));
    }
    
}
