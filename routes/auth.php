<?php



Route::name('auth.')->group(function (){
    Route::get('/signin', [\App\Http\Controllers\auth\SigninController::class, 'index'])->name('signin')->middleware('guest');
    Route::post('/signin', [\App\Http\Controllers\auth\SigninController::class, 'store'])->name('signin.store')->middleware('guest');
    Route::delete('/logout', [\App\Http\Controllers\auth\SigninController::class, 'destroy'])->name('signout')->middleware('auth');


    Route::get('/signup', [\App\Http\Controllers\auth\SignupController::class, 'index'])->name('signup')->middleware('guest');
    Route::post('/signup', [\App\Http\Controllers\auth\SignupController::class, 'store'])->name('signup.store')->middleware('guest');

});
