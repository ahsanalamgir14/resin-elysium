<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CouponController;
use App\Http\Controllers\admin\SizeController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\CustomerController;
use App\Http\Controllers\admin\HomeBannerController;
use App\Http\Controllers\front\FrontController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => false, 'reset' => false, 'verify'=>false]);
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/home', 'index');
});
Route::get('product-view', [ProductController::class, 'product_view']);
Route::get('cart-view', [CartController::class, 'cart_view']);
Route::get('checkout-view', [CheckoutController::class, 'checkout_view']);
Route::get('my-orders', [OrderController::class, 'get_orders']);
Route::get('order-info', [OrderController::class, 'order_information']);
Route::any('all-products', [ProductController::class, 'show_all_products'])->name('product-search');
Route::any('search', [HomeController::class, 'search'])->name('search');
Route::get('logout', [HomeController::class, 'logout']);
Route::group(['middleware' => ['auth']], function () {
    Route::post('place-order', [OrderController::class, 'place_order'])->name('place-order');
});
Route::resource('contact-us', ContactController::class);
// Route::any('/{any}', function () { return redirect('/home');})->where('any', '^(?!api).*$');

// Route::get('admin', [AdminController::class, 'index']);
// Route::get('admin/password_reset', [AdminController::class, 'password_reset']);
// Route::post('auth', [AdminController::class, 'auth'])->name('admin.auth');
// Route::post('admin/generate_link', [AdminController::class, 'generate_link']);
// Route::get('admin/forgot_password_change/{id}',[AdminController::class,'forgot_password_change']);
// Route::post('admin/forgot_password_change_process',[AdminController::class,'forgot_password_change_process']);

Route::group(['middleware' => ['auth'], 'prefix' => 'admin'], function () {
    Route::resource('manage-customers', CustomerController::class);
    Route::resource('manage-admins', AdminController::class);
    Route::resource('manage-banners', HomeBannerController::class);
    Route::resource('manage-products', ProductController::class);
    Route::resource('manage-orders', OrderController::class);
    Route::resource('manage-categories', CategoryController::class);
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard');
});