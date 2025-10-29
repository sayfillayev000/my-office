<?php

use App\Http\Controllers\CustomTabController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\ApplicationController;

// Authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/sms-verify', [AuthController::class, 'showSmsVerify'])->name('sms.verify');
Route::post('/sms-verify', [AuthController::class, 'verifySms'])->name('sms.verify.submit');
Route::post('/sms-resend', [AuthController::class, 'resendSms'])->name('sms.resend');

// Protected routes
Route::middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('permission:dashboard.view')
        ->name('dashboard');
    
    // Custom Tab
    Route::get('/custom-tab', [CustomTabController::class, 'index'])
        ->middleware('permission:custom-tab.view')
        ->name('custom-tab');

    // ======================== EMPLOYEE ROUTES ========================
    
    // Employee CRUD - BU ASOSIY ROUTE
    Route::resource('employees', EmployeeController::class);
    
    // Step-by-step update
    Route::post('/employees/{employee}/update-step/{step}', [EmployeeController::class, 'updateStep'])
        ->name('employees.update-step');
    
    // Image update
    Route::post('/employees/{employee}/update-image', [EmployeeController::class, 'updateImage'])
        ->name('employees.update-image');

    // Passport file routes
    Route::post('/employees/{employee}/upload-passport', [EmployeeController::class, 'uploadPassport'])
        ->name('employees.upload-passport');
    Route::get('/employees/{employee}/view-passport', [EmployeeController::class, 'viewPassport'])
        ->name('employees.view-passport');
    Route::delete('/employees/{employee}/delete-passport', [EmployeeController::class, 'deletePassport'])
        ->name('employees.delete-passport');

    // ======================== EDUCATION ROUTES ========================

    // Bitta education ma'lumotini olish (AJAX)
    Route::get('/employees/{employee}/education/{education}', [EmployeeController::class, 'getEducation'])
        ->name('employees.education.get');

    // Education qo'shish
    Route::post('/employees/{employee}/education', [EmployeeController::class, 'saveEducation'])
        ->name('employees.education.save');

    // Education yangilash
    Route::put('/employees/{employee}/education/{education}', [EmployeeController::class, 'saveEducation'])
        ->name('employees.education.update');

    // Education o'chirish
    Route::delete('/employees/{employee}/education/{education}', [EmployeeController::class, 'deleteEducation'])
        ->name('employees.education.delete');

    // Educationlar ro'yxatini jadval ko'rinishida olish
    Route::get('/employees/{employee}/educations', [EmployeeController::class, 'getEducationsTable'])
        ->name('employees.educations.table');

    // ======================== WORK EXPERIENCE ROUTES ========================

    // Work experience ma'lumotini olish (EDIT uchun)
    Route::get('/employees/{employee}/work-experience/{workExperience}', [EmployeeController::class, 'getWorkExperience'])
        ->name('employees.work-experience.get');

    // Work experience qo'shish
    Route::post('/employees/{employee}/work-experience', [EmployeeController::class, 'saveWorkExperience'])
        ->name('employees.work-experience.save');

    // Work experience yangilash
    Route::put('/employees/{employee}/work-experience/{workExperience}', [EmployeeController::class, 'saveWorkExperience'])
        ->name('employees.work-experience.update');

    // Work experience o'chirish
    Route::delete('/employees/{employee}/work-experience/{workExperience}', [EmployeeController::class, 'deleteWorkExperience'])
        ->name('employees.work-experience.delete');

    // Work experiences ro'yxatini jadval ko'rinishida olish
    Route::get('/employees/{employee}/work-experiences', [EmployeeController::class, 'getWorkExperiencesTable'])
        ->name('employees.work-experiences.table');

    // ======================== RELATIVES ROUTES ========================

    // Qarindoshlar route'lari
    Route::get('/employees/{employee}/relatives-table', [EmployeeController::class, 'getRelativesTable'])
        ->name('employees.relatives.table');
    Route::get('/employees/{employee}/relatives/{relative}', [EmployeeController::class, 'getRelative'])
        ->name('employees.relatives.get');
    Route::post('/employees/{employee}/relatives', [EmployeeController::class, 'saveRelative'])
        ->name('employees.relatives.save');
    Route::put('/employees/{employee}/relatives/{relative}', [EmployeeController::class, 'saveRelative'])
        ->name('employees.relatives.update');
    Route::delete('/employees/{employee}/relatives/{relative}', [EmployeeController::class, 'deleteRelative'])
        ->name('employees.relatives.delete');

    // ======================== OTHER ROUTES ========================


    Route::post('/proxy/menu', function (\Illuminate\Http\Request $request) {
        $sessionId = $request->input('sessionid');

        $response = Http::withHeaders([
            "Content-Type" => "application/json"
        ])->withOptions([
            "verify" => false
        ])->post("https://my.synterra.uz/backs/menu/get_menu_new", [
            "sessionid" => $sessionId,
            "office_token"=>$_COOKIE['my-office-session']
        ]);

        return response()->json($response->json());
    });

    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::post('/applications/{application}/update', [ApplicationController::class, 'updateStatus'])->name('applications.update');
});