<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('/sms-verify', [AuthController::class, 'showSmsVerify'])->name('sms.verify');
    Route::post('/sms-verify', [AuthController::class, 'verifySms'])->name('sms.verify.submit');
    Route::post('/sms-resend', [AuthController::class, 'resendSms'])->name('sms.resend');
    Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('permission:dashboard.view'); 


Route::post('/proxy/menu', function (Request $request) {
    // 1️⃣ Form body dan sessionid olish
    $sessionId = $request->input('sessionid');

    // 2️⃣ Agar local bo‘lsa, static session
    if (app()->environment('local')) {
        $sessionId = "ryd3wprsupdvp7pkt90srqni3o6fdf6z";
    }

    // 3️⃣ Session bo‘lmasa — xatolik
    if (!$sessionId) {
        return response()->json(['error' => 'Session id topilmadi'], 400);
    }

    // 4️⃣ Tashqi API ga yuboramiz
    $response = Http::withHeaders([
        "Content-Type" => "application/json"
    ])->withOptions([
        "verify" => false
    ])->post("https://my.synterra.uz/backs/menu/get_list", [
        "sessionid" => $sessionId
    ]);

    return response()->json($response->json());
});