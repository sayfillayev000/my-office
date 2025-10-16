<?php

use App\Http\Controllers\CustomTabController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\ApplicationController;



    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('/sms-verify', [AuthController::class, 'showSmsVerify'])->name('sms.verify');
    Route::post('/sms-verify', [AuthController::class, 'verifySms'])->name('sms.verify.submit');
    Route::post('/sms-resend', [AuthController::class, 'resendSms'])->name('sms.resend');
    Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('permission:dashboard.view');   
    Route::get('/custom-tab', [CustomTabController::class, 'index'])
    ->middleware('permission:custom-tab.view'); 

    // routes/web.php
Route::group(['middleware' => ['auth']], function() {
    Route::resource('employees', EmployeeController::class);
});

    Route::get('/menu', [MenuController::class, 'index']);
    Route::get('/menuList', [MenuController::class, 'list']);



    Route::post('/proxy/menu', function (\Illuminate\Http\Request $request) {
        $sessionId = $request->input('sessionid');

        // Agar localda bo'lsa static session ishlatamiz
        if (app()->environment('local')) {
            $sessionId = "ryd3wprsupdvp7pkt90srqni3o6fdf6z";
        }

        $response = Http::withHeaders([
            "Content-Type" => "application/json"
        ])->withOptions([
            "verify" => false // SSL cert error bo‘lsa oldini oladi
        ])->post("https://my.synterra.uz/backs/menu/get_list", [
            "sessionid" => $sessionId
        ]);

        return response()->json($response->json());
    });



    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::post('/applications/{application}/update', [ApplicationController::class, 'updateStatus'])->name('applications.update');