<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/home', [UserController::class, 'index'])->name('home');
Route::get('/', [UserController::class, 'index']);
Route::get('/test', [OrderController::class, 'completeOrder']);

Route::group(['prefix' => 'profile'], function () {
    Route::get('/{user}', [UserController::class, 'profile'])->middleware('auth')->name('profile');
});

Route::group(['prefix' => 'product'], function () {
    Route::get('/all', [ProductController::class, 'getAllProducts'])->name('products');
    Route::get('/all/{user}', [ProductController::class, 'getUserProducts'])->middleware('auth')->name('products.user');
    Route::get('/', [ProductController::class, 'index'])->name('product.form');
    Route::get('/sold/{user}', [ProductController::class, 'soldProducts'])->middleware('auth')->name('products.sold');
    Route::get('/purchased/{user}', [ProductController::class, 'purchasedProducts'])->middleware('auth')->name('products.purchased');
    Route::post('/', [ProductController::class, 'create'])->name('product.create');
    Route::get('/{product}', [ProductController::class, 'show'])->name('product.show');
});

Route::group(['prefix' => 'categories'], function () {
Route::get('/', [CategoryController::class, 'index'])->name('categories');
Route::get('/{slug}', [CategoryController::class, 'show'])->name('category');
});

Route::group(['prefix' => 'order'], function () {
    Route::get('/basket', [OrderController::class, 'index'])->name('basket');
    Route::get('/{order}', [OrderController::class, 'orderInfo'])->name('order.info');
    Route::put('/basket', [OrderController::class, 'completeOrder'])->name('basket.complete');
    Route::post('/add/{product}', [OrderController::class, 'addProduct'])->name('product.add');
    Route::post('/remove/{product}', [OrderController::class, 'removeProduct'])->name('product.remove');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
