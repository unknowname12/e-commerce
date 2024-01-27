<?php

use App\Http\Controllers\actions\CategoryController;

Route::get('/category/index', [CategoryController::class,'index'])->name('category.index');
Route::get('/category/show/{slug}', [CategoryController::class,'show'])->name('category.show');
Route::controller(CategoryController::class)->name('category.')->prefix('category')->middleware('auth')->group(function (){
    Route::get('/create', 'create')->name('create');
    Route::get('/edit/{slug}', 'edit')->name('edit');
    Route::post('/create', 'store')->name('store');
    Route::patch('/edit/{slug}', 'update')->name('update');
    Route::delete('/destroy/{slug}', 'destroy')->name('destroy');
});
