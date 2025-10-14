<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{
    public function index()
    {
        $sessionId = Session::getId();

        $response = Http::withHeaders([
            "Content-Type" => "application/json"
        ])->post("https://my.synterra.uz/backs/menu/get_list", [
            "sessionid" => $sessionId
        ]);

        $menu = $response->json('menu') ?? [];

        return view('components.sidebar', compact('menu'));
    }

    public function list(Request $request)
    {
        // Browserdan kelgan cookie ichidan session ID ni olish
        $sessionId = $request->cookie(config('session.cookie')); 
        // config/session.php ichida default nomi 'laravel_session'

        // Agar session_id bo‘lsa API ga yuboramiz
        $response = Http::withHeaders([
            "Content-Type" => "application/json"
        ])->post("https://my.synterra.uz/backs/menu/get_list", [
            "sessionid" => $sessionId
        ]);

        return response()->json($response->json());
    }

}
