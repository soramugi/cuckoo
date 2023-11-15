<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReminderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $reminders = Reminder::query()
            ->where('team_id', Auth::user()->currentTeam->id)
            ->paginate();

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
            'type_mode' => 'required',
            'month' => 'required_if:type_mode,month',
            'week' => 'required_if:type_mode,week',
        ]);

        $data = $request->only(['title', 'description', 'time', 'to']);
        $type = $request->get('type_mode').':';

        if ($request->get('type_mode') === 'month') {
            $type .= $request->get('month');
        } elseif ($request->get('type_mode') === 'week') {
            $type .= $request->get('week');
        }
        $data = array_merge($data, [
            'type' => $type,
            'team_id' => Auth::user()->currentTeam->id,
        ]);

        Reminder::create($data);

        return redirect()->to(route('reminders.index'))->with('success', '作成完了');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reminder $reminder)
    {
        $reminder->load(['team']);

        $valid = true;
        foreach (Auth::user()->allTeams() as $team) {
            if ($reminder->team->id === $team->id) {
                $valid = false;
                Auth::user()->switchTeam($team);
            }
        }
        if ($valid) {
            return abort(403);
        }

        return view('reminders.show', [
            'reminder' => $reminder,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reminder $reminder)
    {
        if (! Auth::user()->isCurrentTeam($reminder->team)) {
            return abort(403);
        }

        return view('reminders.edit', [
            'reminder' => $reminder,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reminder $reminder)
    {
        if (! Auth::user()->isCurrentTeam($reminder->team)) {
            return abort(403);
        }

        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'time' => 'required',
            'to' => 'required|email',
            'type_mode' => 'required',
            'month' => 'required_if:type_mode,month',
            'week' => 'required_if:type_mode,week',
        ]);

        $data = $request->only(['title', 'description', 'time', 'to']);

        $type = $request->get('type_mode').':';

        if ($request->get('type_mode') === 'month') {
            $type .= $request->get('month');
        } elseif ($request->get('type_mode') === 'week') {
            $type .= $request->get('week');
        }
        $data = array_merge($data, [
            'type' => $type,
        ]);

        $reminder->update($data);

        return back()->with('success', '更新完了');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reminder $reminder)
    {
        if (! Auth::user()->isCurrentTeam($reminder->team)) {
            return abort(403);
        }

        $reminder->delete();

        return redirect()->to(route('reminders.index'))->with('success', '削除が完了しました');
    }

    public function export(Request $request)
    {
        $json = Reminder::query()
            ->where('team_id', Auth::user()->currentTeam->id)
            ->get()
            ->toJson();

        return response($json)
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
            $data['team_id'] = Auth::user()->currentTeam->id;

            Reminder::create($data);
        }

        return back()->with('success', 'インポートデータの登録が完了しました');
    }
}
