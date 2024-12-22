<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class BackendController extends Controller
{
    public function adminDashboard()
    {
        return view('backend.index');
    }

    public function adminAddCategory() {
        return view('backend.categories.add');
    }
    
}
