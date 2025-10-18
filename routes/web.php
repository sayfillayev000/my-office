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



// Employee CRUD
Route::resource('employees', EmployeeController::class);

// Step-by-step update (multi-step form yoki progress uchun)
Route::post('/employees/{employee}/update-step/{step}', [EmployeeController::class, 'updateStep'])
    ->name('employees.update-step');


// ======================== EDUCATION ROUTES ========================

// Bitta education ma'lumotini olish (AJAX)
Route::get('/employees/{employee}/education/{education}', [EmployeeController::class, 'getEducation'])
    ->name('employees.education.get');

// Education qo‘shish
Route::post('/employees/{employee}/education', [EmployeeController::class, 'saveEducation'])
    ->name('employees.education.save');

// Education yangilash
Route::put('/employees/{employee}/education/{education}', [EmployeeController::class, 'saveEducation'])
    ->name('employees.education.update');

// Education o‘chirish
Route::delete('/employees/{employee}/education/{education}', [EmployeeController::class, 'deleteEducation'])
    ->name('employees.education.delete');

// Educationlar ro‘yxatini jadval ko‘rinishida olish
Route::get('/employees/{employee}/educations', [EmployeeController::class, 'getEducationsTable'])
    ->name('employees.educations.table');


// ======================== WORK EXPERIENCE ROUTES ========================

// Work experience qo‘shish
Route::post('/employees/{employee}/work-experience', [EmployeeController::class, 'saveWorkExperience'])
    ->name('employees.work-experience.save');

// Work experience yangilash
Route::put('/employees/{employee}/work-experience/{workExperience}', [EmployeeController::class, 'saveWorkExperience'])
    ->name('employees.work-experience.update');

// Work experience o‘chirish
Route::delete('/employees/{employee}/work-experience/{workExperience}', [EmployeeController::class, 'deleteWorkExperience'])
    ->name('employees.work-experience.delete');

// Work experiences ro‘yxatini jadval ko‘rinishida olish
Route::get('/employees/{employee}/work-experiences', [EmployeeController::class, 'getWorkExperiencesTable'])
    ->name('employees.work-experiences.table');
 Route::get('/menu', [MenuController::class, 'index']);
    Route::get('/menuList', [MenuController::class, 'list']);
// ======================== WORK EXPERIENCE ROUTES ========================

// Work experience ma'lumotini olish (EDIT uchun)
Route::get('/employees/{employee}/work-experience/{workExperience}', [EmployeeController::class, 'getWorkExperience'])
    ->name('employees.work-experience.get');

// Work experience qo‘shish
Route::post('/employees/{employee}/work-experience', [EmployeeController::class, 'saveWorkExperience'])
    ->name('employees.work-experience.save');

// Work experience yangilash
Route::put('/employees/{employee}/work-experience/{workExperience}', [EmployeeController::class, 'saveWorkExperience'])
    ->name('employees.work-experience.update');

// Work experience o‘chirish
Route::delete('/employees/{employee}/work-experience/{workExperience}', [EmployeeController::class, 'deleteWorkExperience'])
    ->name('employees.work-experience.delete');

// Work experiences ro‘yxatini jadval ko‘rinishida olish
Route::get('/employees/{employee}/work-experiences', [EmployeeController::class, 'getWorkExperiencesTable'])
    ->name('employees.work-experiences.table');


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