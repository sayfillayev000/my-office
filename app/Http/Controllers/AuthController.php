<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserSession;
use App\Models\MenyuOrganization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{

    public function showLogin()
    {
        return view('pages.login');
    }

    public function login(Request $request)
    {
        $phone = preg_replace('/\D/', '', $request->phone); // faqat raqamlar qoldiradi
    
        $request->merge(['phone' => $phone]);
    
        $request->validate([
            'phone' => 'required|digits:9',
        ]);
    
        $host = $request->getHost();
        $subdomain = explode('.', $host)[0];
    
        $organization = MenyuOrganization::where('subdomain', $subdomain)->first();
        if (!$organization) {
            return back()->withErrors(['domain' => 'Subdomain topilmadi!']);
        }
    
        $employee = User::whereRaw("regexp_replace(phone, '\\D', '', 'g') = ?", [$phone])
            ->where('organization_id', $organization->id)
            ->first();
    
        if (!$employee) {
            return back()->withErrors(['phone' => 'Ushbu tashkilotda bunday foydalanuvchi topilmadi!']);
        }
    
        $code = rand(1000, 9999);
    
        Session::put('phone', $phone);
        Session::put('organization_id', $organization->id);
        Session::put('sms_code', $code);
        Session::put('sms_expires', now()->addMinutes(5));
    
        Log::info("SMS code generated", [
            'phone' => $phone,
            'organization_id' => $organization->id,
            'code' => $code
        ]);
    
        return redirect()->to('/sms-verify')
            ->with('status', 'SMS kod yuborildi!')
            ->with('code', $code);
    }
    

    public function showSmsVerify()
    {
        if (!Session::has('phone')) {
            return redirect()->to('/login');
        }
        return view('pages.sms_verify');
    }

    public function resendSms(Request $request)
    {
        $phone = Session::get('phone');

        if (!$phone) {
            return redirect()->to('/login')
                ->withErrors(['phone' => 'Avval login qiling!']);
        }

        $code = rand(1000, 9999);

        Session::put('sms_code', $code);
        Session::put('sms_expires', now()->addMinutes(5));

        Log::info("Resend SMS code", ['phone' => $phone, 'code' => $code]);

        return back()->with('status', 'Yangi SMS kod yuborildi!')
            ->with('code', $code);
    }

   public function verifySms(Request $request)
{
    $request->validate([
        'code' => 'required|digits:4',
    ]);

    $phone   = Session::get('phone');
    $orgId   = Session::get('organization_id');
    $code    = Session::get('sms_code');
    $expires = Session::get('sms_expires');

    // 1️⃣ Kodni tekshirish
    if ($request->code != $code) {
        return back()->withErrors(['code' => '❌ Kiritilgan kod noto‘g‘ri!']);
    }

    // 2️⃣ Muddati tugaganini tekshirish
    if (now()->greaterThan($expires)) {
        return back()->withErrors(['code' => '⚠️ Kod muddati tugagan!']);
    }

    // 3️⃣ Foydalanuvchini topish
    $employee = User::where('phone', $phone)
        ->where('organization_id', $orgId)
        ->first();

    if (!$employee) {
        return back()->withErrors(['code' => 'Foydalanuvchi topilmadi!']);
    }

    // 4️⃣ Login
    Auth::login($employee);
    $request->session()->regenerate();

    UserSession::updateOrCreate(
        ['session_id' => Session::getId()],
        [
            'user_id' => $employee->id,
            'organization_id' => $orgId,
        ]
    );

    Session::forget(['sms_code', 'sms_expires']);
    if(app()->environment('production')) {
        return redirect()->to('/backs/user/profile')
            ->with('status', '✅ Test muhitida muvaffaqiyatli kirdingiz!');
    }
    return redirect()->to('/dashboard');
}

}
