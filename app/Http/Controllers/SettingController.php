<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit(Request $request)
    {
        return view('setting.edit');
    }
}
