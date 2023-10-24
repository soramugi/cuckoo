<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('reminders.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reminders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return back()->with('success', '作成完了');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reminder $reminder)
    {
        return view('reminders.show', [
            'reminder' => $reminder,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reminder $reminder)
    {
        return view('reminders.edit', [
            'reminder' => $reminder,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reminder $reminder)
    {
        return back()->with('success', '更新完了');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reminder $reminder)
    {
        return redirect()->to(route('reminders.index'))->with('success', '削除が完了しました');
    }
}
