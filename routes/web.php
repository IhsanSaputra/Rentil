<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MainController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Public Routes (Tidak Memerlukan Login)
|--------------------------------------------------------------------------
*/

// Halaman utama langsung ke semua mobil
Route::get('/', [MainController::class, 'allCars'])->name('main');

// Halaman informasi umum
Route::get('/category/{category}', [CategoryController::class, 'categoryCars'])->name('category_cars');
Route::get('/car/{id}', [CarController::class, 'infoCar'])->name('car_info');
Route::get('/rental_rules', [MainController::class, 'rentRules'])->name('rental_rules');
Route::get('/about_us', [MainController::class, 'aboutUs'])->name('about_us');

/*
|--------------------------------------------------------------------------
| User Routes (Wajib Login sebagai User)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Checkout mobil
    Route::get('/checkout/{id}', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/{id}', [CheckoutController::class, 'checkoutForm'])->name('checkoutForm');

    // Profil user
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Tanpa Middleware khusus)
|--------------------------------------------------------------------------
*/
// Login admin manual
Route::get('/login_admin', [AdminController::class, 'loginAdmin'])->name('login_admin');
Route::post('/login_admin', [AdminController::class, 'loginAdminForm'])->name('login_admin_form');

// Dashboard admin
Route::get('/admin_dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard');

// Manajemen Pesanan
Route::get('/admin_orders', [AdminController::class, 'ordersAdmin'])->name('orders');
Route::get('/order_info/{id}', [AdminController::class, 'orderInfo'])->name('order_info');
Route::get('/edit_order/{id}', [AdminController::class, 'showEditOrderForm'])->name('edit_order_form');
Route::post('/edit_order/{id}', [AdminController::class, 'editOrder'])->name('edit_order');
Route::delete('/delete_order/{id}', [AdminController::class, 'deleteOrder'])->name('delete_order');

// Manajemen Mobil / Produk
Route::get('/products', [AdminController::class, 'products'])->name('products');
Route::get('/add_product', [AdminController::class, 'showAddProduct'])->name('add_product_form');
Route::post('/add_product', [AdminController::class, 'addProduct'])->name('add_product');
Route::get('/edit_product/{id}', [AdminController::class, 'showEditProduct'])->name('edit_product_form');
Route::post('/edit_product/{id}', [AdminController::class, 'editProduct'])->name('edit_product');
Route::get('/delete_product/{id}', [AdminController::class, 'deleteProduct'])->name('delete_product');

// Manajemen Pengguna (User)
Route::get('/admin_users', [AdminController::class, 'usersAdmin'])->name('admin_users');
Route::delete('/delete_user/{id}', [AdminController::class, 'deleteUser'])->name('delete_user');

/*
|--------------------------------------------------------------------------
| Auth Routes (Dari Laravel Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Logout Manual (Bisa Digunakan untuk User/Admin)
|--------------------------------------------------------------------------
*/
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');
