<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;

class frontendController extends Controller
{
    public function home(){

    //     $user = new User();
    //     $user->name        = 'Administrator';
    //     $user->email       = 'admin@gmail.com';
    //     $user->password    = Hash::make('123456789000');
    //     $user->created_at  =Carbon::now();

    //     $user->save();
    //     $user->assignRole('admin'); 
    //   return $user;
         return view('frontend.index');
    }
}
