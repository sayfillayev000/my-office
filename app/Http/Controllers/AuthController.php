<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\MenyuEmployee;
use App\Models\SmsCode;

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
        $request->validate([
            'phone' => 'required|digits:9',
        ]);
        $employee = MenyuEmployee::where('phone', $request->phone)->first();

        if (!$employee) {
            return back()->withErrors(['phone' => 'Telefon raqam topilmadi!'])->withInput();
        }

        $code = rand(1000, 9999);

        SmsCode::where('phone', $request->phone)->delete();

        SmsCode::create([
            'phone' => $request->phone,
            'code'  => $code,
        ]);

        Session::put('phone', $request->phone);
        return redirect()->route('sms.verify')
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

        return redirect()->route('dashboard');
    }

    return back()->withErrors(['code' => 'Kod noto‘g‘ri!']);
}


}
