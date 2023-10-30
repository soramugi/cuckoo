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
        $reminders = Reminder::query()->paginate();

        return view('reminders.index', [
            'reminders' => $reminders,
        ]);
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
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'time' => 'required',
            'to' => 'required|email',
            'type' => 'required',
            'day' => 'required_if:type,month',
            'week' => 'required_if:type,week',
        ]);

        $data = $request->only(['title', 'description', 'time', 'to']);
        if ($request->get('type') === 'month') {
            $data = array_merge($data, $request->only('day'));
        } else {
            $data = array_merge($data, $request->only('week'));
        }

        Reminder::create($data);

        return redirect()->to(route('reminders.index'))->with('success', '作成完了');
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
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'time' => 'required',
            'to' => 'required|email',
            'type' => 'required',
            'day' => 'required_if:type,month',
            'week' => 'required_if:type,week',
        ]);

        $data = $request->only(['title', 'description', 'time', 'to']);
        if ($request->get('type') === 'month') {
            $data = array_merge($data, $request->only('day'));
        } else {
            $data = array_merge($data, $request->only('week'));
        }

        $reminder->update($data);

        return back()->with('success', '更新完了');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reminder $reminder)
    {
        $reminder->delete();

        return redirect()->to(route('reminders.index'))->with('success', '削除が完了しました');
    }

    public function export(Request $request)
    {
        return response(Reminder::all()->toJson())
            ->withHeaders([
                'Content-Type' => 'application/force-download',
                'Content-Disposition' => 'attachment; filename="data.json"',
            ]);
    }

    public function import(Request $request)
    {
        $file = $request->file('json');
        $content = file_get_contents($file->getRealPath());
        $json = json_decode($content);

        foreach ($json as $obj) {
            $data = (array) $obj;
            unset($data['id']);
            unset($data['compleded_at']);
            Reminder::create($data);
        }

        return back()->with('success', 'インポートデータの登録が完了しました');
    }
}
