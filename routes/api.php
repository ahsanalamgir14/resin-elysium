<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\CustomerController;

/*
|--------------------
------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('add-to-cart', [CartController::class, 'add_to_cart'])->name('add-to-cart');
Route::post('search', [HomeController::class, 'search'])->name('search');
Route::get('get-states', [CommonController::class, 'get_states']);
Route::get('get-cities', [CommonController::class, 'get_cities']);
Route::post('products-filter', [ProductController::class, 'apply_filters']);
Route::get('get-cart-items', [CartController::class, 'get_cart_items']);
Route::post('update-cart', [CartController::class, 'update']);
Route::post('delete-cart-item', [CartController::class, 'destroy']);
Route::post('change-order-status', [OrderController::class, 'change_order_status']);
Route::post('get-user-details', [CustomerController::class, 'get_user_details']);
Route::post('get-product-details', [ProductController::class, 'get_product_details']);
