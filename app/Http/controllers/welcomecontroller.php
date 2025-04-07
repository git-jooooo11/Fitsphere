<?php
// Register route
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Password reset route
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');