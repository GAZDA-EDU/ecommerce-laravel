<?php

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
Route::controller(BrandsController::class)->group(function(){
    Route::get('index', 'index');
    Route::get('show/{id}', 'show');
    Route::post('store', 'store');
    Route::put('update_brand/{id}', 'update_brand');
    Route::delete('delete_brand/{id}', 'delete_brand');
});

// Category CRUD
Route::controller(CategoryController::class)->group(function(){
    Route::get('index', 'index');
    Route::get('show/{id}', 'show');
    Route::post('store', 'store');
    Route::put('update_category/{id}', 'update_category');
    Route::delete('delete_category/{id}', 'delete_category');
});

Route::controller(LocationController::class)->group(function(){
    Route::post('store', 'store');
    Route::put('update/{id}', 'update');
    Route::delete('destroy/{id}', 'destroy');
});

Route::controller(ProductController::class)->group(function(){
    Route::get('index', 'index');
    Route::get('show/{id}', 'show');
    Route::post('store', 'store');
    Route::put('update/{id}', 'update');
    Route::delete('destroy/{id}', 'destroy');
});
