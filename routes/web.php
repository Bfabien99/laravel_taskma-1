<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::controller(AuthController::class)->group(function(){
        Route::middleware('guest')->group(function(){
            Route::get('/login', 'login')->name('login');
            Route::post('/login', 'handle_login');
            Route::get('/register', 'register')->name('register');
            Route::post('/register', 'handle_register');
        });
        Route::get('/logout', 'logout')->name('logout')->middleware('auth');
});