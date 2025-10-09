<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/sms-verify', [AuthController::class, 'showSmsVerify'])->name('sms.verify');
Route::post('/sms-verify', [AuthController::class, 'verifySms'])->name('sms.verify.submit');
Route::post('/sms-resend', [AuthController::class, 'resendSms'])->name('sms.resend');



Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
