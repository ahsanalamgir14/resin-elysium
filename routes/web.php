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
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\StripeController;


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
// Route::any('/{any}', function () { return redirect('/home');})->where('any', '^(?!api).*$');

Auth::routes(['verify' => true]);
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/home', 'index')->name('home');
});
Route::get('product-view', [ProductController::class, 'product_view']);
Route::get('cart-view', [CartController::class, 'cart_view']);
Route::get('checkout-view', [CheckoutController::class, 'checkout_view']);
Route::get('my-orders', [OrderController::class, 'get_orders']);
// Route::get('order-info', [OrderController::class, 'order_information']);
Route::any('all-products', [ProductController::class, 'show_all_products'])->name('product-search');
Route::any('search', [HomeController::class, 'search'])->name('search');
Route::get('profile', [HomeController::class, 'profile'])->name('my-profile');
Route::get('account', [HomeController::class, 'account'])->name('my-account');
Route::post('change-password', [HomeController::class, 'change_password'])->name('change-password');
Route::get('order/{id}', [OrderController::class, 'order_information']);
Route::get('/stripe-payment', [StripeController::class, 'handleGet']);
Route::post('/stripe-payment', [StripeController::class, 'handlePost'])->name('stripe.post');
Route::get('logout', [HomeController::class, 'logout']);
Route::group(['middleware' => ['auth']], function () {
    Route::post('place-order', [OrderController::class, 'place_order'])->name('place-order');
});
Route::resource('contact-us', ContactController::class);
Route::post('store-query', [ContactController::class, 'store'])->name('save_query');
Route::get('about-us', [CommonController::class, 'about_us']);

Route::group(['middleware' => ['auth'], 'prefix' => 'admin'], function () {
    Route::resource('manage-customers', CustomerController::class);
    Route::resource('manage-admins', AdminController::class);
    Route::resource('manage-banners', HomeBannerController::class);
    Route::resource('manage-products', ProductController::class);
    Route::resource('manage-orders', OrderController::class);
    Route::resource('manage-categories', CategoryController::class);
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard');
    Route::post('register-user', [AdminController::class, 'register_user'])->name('user-registration');
});

Route::resource('contact-us', ContactController::class);
