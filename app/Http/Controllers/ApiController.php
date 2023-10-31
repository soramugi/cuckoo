<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ApiController extends Controller
{
    public function cron(Request $request)
    {
        if (config('app.php_binary')) {
            \putenv('PHP_BINARY='.config('app.php_binary'));
        }
        Artisan::call('schedule:run');

        return Artisan::output();
    }
}
