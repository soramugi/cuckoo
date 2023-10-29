<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TopController extends Controller
{
    public function index(Request $request)
    {
        return view('top.index');
    }

    public function dashboard(Request $request)
    {
        return view('top.dashboard');
    }
}
