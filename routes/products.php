<?php

use App\Http\Controllers\actions\ProductController;

Route::get('/product/index', [ProductController::class,'index'])->name('product.index');
Route::get('/product/index/view', [ProductController::class,'search'])->name('product.search');

Route::controller(ProductController::class)->name('product.')->prefix('product')->middleware('auth')->group(function (){
    Route::get('/create', 'create')->name('create');
    Route::get('/show/{slug}', 'show')->name('show');
    Route::get('/edit/{slug}', 'edit')->name('edit');
    Route::post('/create', 'store')->name('store');
    Route::patch('/edit/{slug}', 'update')->name('update');
    Route::delete('/destroy/{slug}', 'destroy')->name('destroy');
});
