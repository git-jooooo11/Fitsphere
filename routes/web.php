<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\welcomeController;

Route::get('/', [welcomeController::class, 'index'])->name('welcome');

    // Register route
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    
    // Password reset route
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    // Route to display the login form
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    
    // Route to handle the login form submission
    Route::post('/login', [LoginController::class, 'login'])->name('login');
