<?php

use Illuminate\Support\Facades\Route;

Route::get('/app', function () {
    return view('tache.app');
});
Route::get('/', [\App\Http\Controllers\TacheSecController::class,'index'])->name('index')->middleware('auth');
Route::resource('/tache', \App\Http\Controllers\TacheSecController::class);
// pour la security
Route::get('/login', [\App\Http\Controllers\Security::class,'index'])->name('login');
Route::post('/login/post', [\App\Http\Controllers\Security::class,'login'])->name('login.post');
Route::get('/logout', [\App\Http\Controllers\Security::class,'logout'])->name('logout');
