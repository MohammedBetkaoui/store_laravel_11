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
    Route::get('/productsByCategory/{id}','productByCategory')->name('products.by.category');
    Route::get('/product/{id}', 'show_product')->name('show.detail');





});
// Routes Backend avec Middleware
Route::middleware(['auth', 'verified'])->group(function () {
    Route::controller(BackendController::class)->group(function () {
        Route::get('/admin/dashboard', 'adminDashboard')->name('admin.dashboard');
        Route::get('/add_category', 'adminAddCategory')->name('add.category');
        Route::post('/store_category', 'adminStoreCategory')->name('store.category');
        Route::get('/view_categories', 'adminViewCategories')->name('view.categories');
        Route::get('/view_Products', 'adminViewProducts')->name('view.products');
        Route::get('/fetch_categories', 'fetchCategories')->name('fetch.categories'); // Route Ajax
        Route::delete('/delete_category/{id}', 'deleteCategory')->name('delete.category'); // Route suppression
        Route::get('/edit_category/{id}', 'editCategory')->name('edit.category');
        Route::put('/update_category/{id}', 'updateCategory')->name('update.category');
        Route::get('/add_product','addProduct')->name('add.product');
        Route::post('/store_product', 'storeProduct')->name('store.product');
        Route::delete('/delete_product/{id}', 'deleteProduct')->name('delete.product');
        Route::get('/fetch_products', 'fetchProducts')->name('fetch.products'); // Route pour récupérer les produits via Ajax
        Route::get('/edit_product/{id}', 'editProduct')->name('edit.product'); // Route pour éditer un produit
        Route::put('/update_product/{id}', 'updateProduct')->name('update.product'); // Route pour mettre à jour le produit
        Route::get('/products/{id}','show')->name('product.show');





        
    });
});



// Routes Profil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth Routes
require __DIR__ . '/auth.php';
