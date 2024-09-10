<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
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

Route::middleware('auth')->group(function(){
    Route::get('/space', function(){
        if(auth()->user()->role == "user") return to_route('user.index');
        if(auth()->user()->role == "admin") return to_route('admin.index');
    })->name('myspace');


    Route::get('/myspace', function(){
        return view('user.index');
    })->name('user.index');
    
    Route::resource('tasks', TaskController::class);
    Route::resource('projects', ProjectController::class);
});