<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomTabController extends Controller
{
    public function index()
    {
        return view('pages.employee');
    }
}
