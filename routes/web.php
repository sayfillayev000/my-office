<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::group([
    'prefix' => '{prefix?}', 
    'where' => ['prefix' => 'backm|backs|mizan|tmk'] // shu so‘zlardan biri bo‘lishi yoki bo‘sh bo‘lishi mumkin
], function () {
    // Login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    // SMS verify
    Route::get('/sms-verify', [AuthController::class, 'showSmsVerify'])->name('sms.verify');
    Route::post('/sms-verify', [AuthController::class, 'verifySms'])->name('sms.verify.submit');
    Route::post('/sms-resend', [AuthController::class, 'resendSms'])->name('sms.resend');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});