<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


// AUTHENTICATION
Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register')->name('register'); //PUBLIC ROUTE
    Route::post('/login', 'login')->name('login'); //PUBLIC ROUTE
    Route::post('/logout', 'logout')->name('logout')->middleware('auth:api'); //PROTECTED AUTH ROUTE
});

// CATEGORIES
Route::controller(CategoryController::class)->middleware(['auth:api', 'admin'])->group(function () {
    Route::get('/category', 'index')->withoutMiddleware(['auth:api', 'admin']); //PUBLIC ROUTE
    Route::get('/category/{slug}', 'show')->withoutMiddleware(['auth:api', 'admin']); //PUBLIC ROUTE
    Route::post('/category', 'store'); //PROTECTED ROUTE ONLY FOR ADMIN 
    Route::put('/category/{slug}', 'update'); //PROTECTED ROUTE ONLY FOR ADMIN 
    Route::delete('/category/{slug}', 'destroy'); //PROTECTED ROUTE ONLY FOR ADMIN 
});

// PRODUCTS
Route::controller(ProductController::class)->middleware(['auth:api', 'admin'])->group(function () {
    Route::get('/product', 'index')->withoutMiddleware(['auth:api', 'admin']); // PUBLIC ROUTE
    Route::get('/product/{id}', 'show')->whereNumber('id')->withoutMiddleware(['auth:api', 'admin']); // PUBLIC ROUTE
    Route::get('/product/search', 'search')->withoutMiddleware(['auth:api', 'admin']); // PUBLIC ROUTE;
    Route::post('/product', 'store'); //PROTECTED ONLY ADMIN ROUTE
    Route::put('/product/{id}', 'update')->whereNumber('id'); //PROTECTED ROUTE ONLY FOR ADMIN 
    Route::delete('/product/{id}', 'destroy')->whereNumber('id'); //PROTECTED ROUTE ONLY FOR ADMIN 
});

// CONTACT
Route::controller(ContactController::class)->middleware(['auth:api', 'admin'])->group(function () {
    // ALL PROTECTED ROUTE ONLY FOR ADMIN 
    Route::get('/contact', 'index');
    Route::get('/contact/{id}', 'show')->whereNumber('id');
    Route::post('/contact', 'store');
    Route::put('/contact/{id}', 'update')->whereNumber('id');
    Route::delete('/contact/{id}', 'destroy')->whereNumber('id');
});
