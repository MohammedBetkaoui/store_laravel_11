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

public function productByCategory($id){

    $products = Product::where('category_id','=', $id)->latest()->paginate(10);
   $category =category::where('id','=', $id)->first();
    return view('frontend.productsByCategory', compact('products','category'));
}
}
