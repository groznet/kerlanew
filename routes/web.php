<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showPhoneForm'])->name('login');
Route::post('/login/code', [AuthController::class, 'requestCode'])->name('auth.request-code');
Route::get('/login/verify', [AuthController::class, 'showVerifyForm'])->name('auth.verify');
Route::post('/login/verify', [AuthController::class, 'verifyCode'])->name('auth.verify-code');
Route::get('/register/details', [AuthController::class, 'showRegistrationForm'])->name('auth.register');
Route::post('/register/details', [AuthController::class, 'completeRegistration'])->name('auth.complete-registration');
Route::view('/terms', 'pages.terms')->name('terms');
Route::view('/consent', 'pages.consent')->name('consent');

Route::middleware('auth')->group(function () {
    Route::get('/account', [AuthController::class, 'showCompleted'])->name('auth.completed');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
