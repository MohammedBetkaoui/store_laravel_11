<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontendController;
use App\Http\Controllers\backendController;
use App\Http\Middleware\IsAdmin;


// Routes Frontend
Route::controller(frontendController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::any('/user/login', 'login')->name('user.login');


Route::get('/forgint-password', 'forgint_password')->name('forgint-password');
});
// Routes Backend avec Middleware
Route::middleware(['auth', 'verified', IsAdmin::class])->group(function () {
    Route::controller(BackendController::class)->group(function () {
        Route::get('/admin/dashboard', 'adminDashboard')->name('admin.dashboard');
    });
});


// Dashboard
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Routes Profil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth Routes
require __DIR__ . '/auth.php';
