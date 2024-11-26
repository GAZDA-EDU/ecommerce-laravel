<?php

use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProductController;
use App\Models\Product;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/signup', [AuthController::class, 'signup']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});

// Brands CRUD
Route::group(['prefix'=>'brands'], function($router){
    Route::controller(BrandsController::class)->group(function(){
        Route::get('index', 'index')->middleware('is_admin');
        Route::get('show/{id}', 'show')->middleware('is_admin');
        Route::post('store', 'store')->middleware('is_admin');
        Route::put('update_brand/{id}', 'update_brand')->middleware('is_admin');
        Route::delete('delete_brand/{id}', 'delete_brand')->middleware('is_admin');
    });
});


// Category CRUD
Route::group(['prefix'=>'category'], function($router){
    Route::controller(CategoryController::class)->group(function(){
        Route::get('index', 'index')->middleware('is_admin');
        Route::get('show/{id}', 'show')->middleware('is_admin');
        Route::post('store', 'store')->middleware('is_admin');
        Route::put('update_category/{id}', 'update_category')->middleware('is_admin');
        Route::delete('delete_category/{id}', 'delete_category')->middleware('is_admin');
    });
});


// Location CRUD
Route::group(['prefix'=>'location'],function($router){
    Route::controller(LocationController::class)->group(function(){
        Route::post('store', 'store')->middleware('auth');
        Route::put('update/{id}', 'update')->middleware('auth');
        Route::delete('destroy/{id}', 'destroy')->middleware('auth');
    });
});

// Product CRUD
Route::group(['prefix'=>'product'], function($router){
    Route::controller(ProductController::class)->group(function(){
        Route::get('index', 'index')->middleware('auth');
        Route::get('show/{id}', 'show')->middleware('auth');
        Route::post('store', 'store')->middleware('is_admin');
        Route::put('update/{id}', 'update')->middleware('is_admin');
        Route::delete('destroy/{id}', 'destroy')->middleware('is_admin');
    });
});


// Order CRUD
Route::group(['prefix'=>'orders'], function($router){
    Route::controller(OrderController::class)->group(function(){
        Route::get('index', 'index')->middleware('is_admin');
        Route::get('show/{id}', 'show')->middleware('is_admin');
        Route::post('store', 'store')->middleware('auth');
        Route::get('get_order_items/{id}', 'get_order_items')->middleware('is_admin');
        Route::get('get_user_orders/{id}', 'get_user_orders')->middleware('is_admin');
        Route::post('change_order_status/{id}', 'change_order_status')->middleware('is_admin');
    });
});

