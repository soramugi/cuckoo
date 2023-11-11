<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopController extends Controller
{
    public function index(Request $request)
    {
        $reminderCount = Reminder::query()
            ->where('team_id', Auth::user()->currentTeam?->id)
            ->count();

        $reminderLast = Reminder::query()
            ->where('team_id', Auth::user()->currentTeam?->id)
            ->orderBy('compleded_at', 'desc')
            ->first();
        $reminderLastTime = $reminderLast?->compleded_at;

        return view('top.index', [
            'reminderCount' => $reminderCount,
            'reminderLastTime' => $reminderLastTime,
        ]);
    }
}
