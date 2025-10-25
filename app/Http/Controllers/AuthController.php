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

        if ($request->code == $code && now()->lessThan($expires)) {
            // Same normalization when verifying SMS
            $employee = User::whereRaw("(case when regexp_replace(phone, '\\\\D', '', 'g') like '998%' then substr(regexp_replace(phone, '\\\\D', '', 'g'), 4) else regexp_replace(phone, '\\\\D', '', 'g') end) = ?", [$phone])
                ->where('organization_id', $orgId)
                ->first();

            if (!$employee) {
                return back()->withErrors(['code' => 'Foydalanuvchi topilmadi!']);
            }

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

            return redirect()->to('/dashboard');
        }

        return back()->withErrors(['code' => 'Kod noto‘g‘ri yoki muddati tugagan!']);
    }
}
