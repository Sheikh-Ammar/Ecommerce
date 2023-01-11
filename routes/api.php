<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// CATEGORIES
Route::controller(CategoryController::class)->group(function () {
    Route::get('/category', 'index');
    Route::get('/category/{slug}', 'show');
    Route::post('/category', 'store');
    Route::put('/category/{slug}', 'update');
    Route::delete('/category/{slug}', 'destroy');
});

// PRODUCTS
Route::controller(ProductController::class)->group(function () {
    Route::get('/product', 'index');
    Route::get('/product/{id}', 'show')->whereNumber('id');
    Route::post('/product', 'store');
    Route::put('/product/{id}', 'update')->whereNumber('id');
    Route::delete('/product/{id}', 'destroy')->whereNumber('id');
});

// CONTACT
Route::controller(ContactController::class)->group(function () {
    Route::get('/contact', 'index');
    Route::get('/contact/{id}', 'show')->whereNumber('id');
    Route::post('/contact', 'store');
    Route::put('/contact/{id}', 'update')->whereNumber('id');
    Route::delete('/contact/{id}', 'destroy')->whereNumber('id');
});
