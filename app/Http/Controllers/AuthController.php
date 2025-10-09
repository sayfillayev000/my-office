<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\MenyuEmployee;
use App\Models\SmsCode;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\UserToken;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('pages.login');
    }
    
    public function login(Request $request)
    {
     // 1) Validate
     $request->validate([
        'phone' => 'required|digits:9',
    ]);

    Log::info('Login request started', ['phone' => $request->phone, 'ip' => $request->ip()]);

    // 2) Find employee
    $employee = MenyuEmployee::where('phone', $request->phone)->first();

    if (!$employee) {
        Log::warning('Login attempt with unknown phone', [
            'phone' => $request->phone,
            'ip' => $request->ip(),
        ]);
        return back()->withErrors(['phone' => 'Telefon raqam topilmadi!'])->withInput();
    }

    Log::info('Employee found for login', [
        'phone' => $request->phone,
        'employee_id' => $employee->id ?? null,
    ]);

    // 3) Generate code
    $code = rand(1000, 9999);
    Log::debug('Generated SMS code', ['phone' => $request->phone, 'code' => $code]);

    // 4) Remove old codes
    try {
        SmsCode::where('phone', $request->phone)->delete();
        Log::info('Old SMS codes deleted', ['phone' => $request->phone]);
    } catch (\Throwable $e) {
        Log::error('Failed to delete old SMS codes', [
            'phone' => $request->phone,
            'error' => $e->getMessage(),
        ]);
        // davom etamiz — lekin siz istasangiz bu yerda return yoki throw qilishingiz mumkin
    }

    // 5) Create new code (with error handling)
    try {
        SmsCode::create([
            'phone' => $request->phone,
            'code'  => $code,
        ]);
        Log::info('New SMS code stored', ['phone' => $request->phone]);
    } catch (\Throwable $e) {
        Log::error('Failed to create SMS code', [
            'phone' => $request->phone,
            'error' => $e->getMessage(),
        ]);
        return back()->withErrors(['phone' => 'SMS kodni saqlashda xatolik yuz berdi.'])->withInput();
    }

    // 6) Sessionga yozish
    Session::put('phone', $request->phone);
    Log::info('Phone stored in session', ['phone' => $request->phone, 'session_id' => session()->getId()]);

    // 7) Redirect — agar developmentda kodni ko'rishni istasangiz, logda 'code' bor; productionda buni olib tashlang.
    return redirect('/backm/sms-verify')
        ->with('status', 'SMS kod yuborildi!')
        ->with('code', $code);
}


    public function resendSms(Request $request)
    {
        $phone = Session::get('phone');

        if (!$phone) {
            return redirect()->route('login')->withErrors(['phone' => 'Avval telefon raqam kiriting!']);
        }

        SmsCode::where('phone', $phone)->delete();

        $code = rand(1000, 9999);

        SmsCode::create([
            'phone' => $phone,
            'code'  => $code,
        ]);

        return back()
            ->with('status', 'Yangi SMS kod yuborildi!')
            ->with('code', $code); 
    }


    public function showSmsVerify()
    {
        if (!Session::has('phone')) {
            return redirect()->route('login');
        }
        return view('pages.sms_verify');
    }



public function verifySms(Request $request)
{
    $request->validate([
        'code' => 'required|digits:4'
    ]);

    $phone = Session::get('phone');

    $sms = SmsCode::where('phone', $phone)
        ->where('code', $request->code)
        ->first();

    if ($sms) {
        $sms->delete();

        $employee = MenyuEmployee::where('phone', $phone)->first();

        // eski tokenlarni o‘chir
        UserToken::where('employee_id', $employee->id)->delete();

        // yangi token yarat
        $token = Str::random(40);

        UserToken::create([
            'employee_id'   => $employee->id,
            'session_key_id'=> $token,
            'expires_at'    => now()->addDays(7), // 7 kun amal qiladi
        ]);

        // Cookie-ga yozamiz (HTTP-only, Secure)
        Cookie::queue(
            Cookie::make('session_key_id', $token, 60*24*7, null, null, true, true, false, 'Strict')
        );

        Session::put('is_logged_in', true);
        Auth::login($employee);
        $request->session()->regenerate();
        return redirect('/backs/user/profile');
    }

    return back()->withErrors(['code' => 'Kod noto‘g‘ri!']);
}


}
