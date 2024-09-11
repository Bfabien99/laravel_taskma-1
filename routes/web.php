<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MailableController;
use App\Http\Controllers\ProfilController;
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
    Route::controller(ProfilController::class)->group(
        function(){
            Route::get('/profil', 'index')->name('profil');
            Route::put('/profil-password', 'update_pass')->name('profil.pass');
            Route::put('/profil-info', 'update_info')->name('profil.info');
        }
    );
});

Route::controller(MailableController::class)->group(function(){
    Route::get('/reset', 'reset_confirm')->name('reset');
    Route::post('/reset', 'handle_reset_confirm')->name('reset.post');
    Route::get('/password_reset', 'reset_password')->name('pass-reset');
    Route::post('/password_reset', 'handle_reset_password')->name('pass-reset.post');
});