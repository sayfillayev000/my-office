<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{

    public function showLogin(){
        return view('pages.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required|digits:9',
        ]);

        // 1. Subdomain olish
        $host = $request->getHost(); // masalan: org1.yoursite.com
        $subdomain = explode('.', $host)[0]; // org1

        // 2. Organization check
        $organization = \App\Models\MenyuOrganization::where('subdomain', $subdomain)->first();
        if (!$organization) {
            return back()->withErrors(['domain' => 'Subdomain topilmadi!']);
        }

        // 3. Foydalanuvchini organization_id bo‘yicha tekshirish
        $employee = User::where('phone', $request->phone)
                        ->where('organization_id', $organization->id)
                        ->first();

        if (!$employee) {
            return back()->withErrors(['phone' => 'Ushbu tashkilotda bunday foydalanuvchi topilmadi!']);
        }

        // 4. SMS kod yaratish
        $code = rand(1000, 9999);

        Session::put('phone', $request->phone);
        Session::put('organization_id', $organization->id);
        Session::put('sms_code', $code);
        Session::put('sms_expires', now()->addMinutes(5));

        \Log::info("SMS code generated", [
            'phone' => $request->phone,
            'organization_id' => $organization->id,
            'code' => $code
        ]);

        return redirect()->route('sms.verify')
            ->with('status', 'SMS kod yuborildi!')
            ->with('code', $code); // dev/test uchun
    }

    public function showSmsVerify()
    {
        if (!Session::has('phone')) {
            return redirect()->route('login');
        }
        return view('pages.sms_verify');
    }
    public function resendSms(Request $request)
    {
        $phone = Session::get('phone');

        if (!$phone) {
            return redirect()->route('login')->withErrors(['phone' => 'Avval login qiling!']);
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

        $phone = Session::get('phone');
        $orgId = Session::get('organization_id');
        $code  = Session::get('sms_code');
        $expires = Session::get('sms_expires');

        if ($request->code == $code && now()->lessThan($expires)) {
            $employee = User::where('phone', $phone)
                            ->where('organization_id', $orgId)
                            ->first();

            if (!$employee) {
                return back()->withErrors(['code' => 'Foydalanuvchi topilmadi!']);
            }

            $request->session()->regenerate();
            Auth::login($employee);
            Session::forget(['sms_code', 'sms_expires']);

            return redirect()->route('dashboard');
        }

        return back()->withErrors(['code' => 'Kod noto‘g‘ri yoki muddati tugagan!']);
    }


}
