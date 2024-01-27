<?php

use App\Http\Controllers\actions\CartController;
use Illuminate\Support\Facades\Route;

Route::controller(CartController::class)->name('cart.')->prefix('cart')->middleware('auth')->group(function (){
    Route::get('/index/{slug}', 'index')->name('index');
    Route::get('/index/payment/{slug}', 'paymentIndex')->name('index.payment');
    Route::post('/create', 'store')->name('store');
    Route::patch('/edit/{slug}', 'update')->name('update');
    Route::patch('/payment', 'payment')->name('payment');
    Route::delete('/destroy/{slug}', 'destroy')->name('destroy');
});
