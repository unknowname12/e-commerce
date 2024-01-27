<?php

use App\Http\Controllers\actions\{CartController, CategoryController, ProductController};
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;


Route::name('view.')->controller(PagesController::class)->group(function (){
    Route::get('/', 'home')->name('home');
    Route::get('/action', 'action')->name('action')->middleware('auth');
});

require __DIR__ . '/carts.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/products.php';
require __DIR__ . '/categories.php';
