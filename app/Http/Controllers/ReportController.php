<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;

use Illuminate\View\View;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /*public function create(): View
    {
        return view('reports.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $user = auth()->user();

        $request->validate([
            'title'         => 'required|string',
            'tag'           => 'required|string',
            'anonymous'     => 'required|boolean',
            'public'        => 'required|boolean',
            'description'   => 'required|string',
            'photo'         => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $photo = $request->file('photo');
        $photo->storeAs('public/reports/user_' . $user->id, $photo->hashName());

        $anonymous = $request->anonymous;

        $report = $user->reports->create([
            'title'         => $request->title,
            'tag'           => $request->platform,
            'anonymous'     => $request->anonymous,
            'public'        => $request->public,
            'author'        => $anonymous ? 'Anonymous' : $user->name,
            'description'   => $request->description,
            'report_date'   => now()->format('d M Y'),
            'photo'         => $photo->hashName(),
        ]);

        return redirect()->route('reports.index');
    }*/

    public function show(string $id): View
    {
        $report = Report::findOrFail($id);

        return view('report-details', compact('report'));
    }

    /*public function destroy($id): RedirectResponse
    {
        $user = auth()->user();

        $report = Report::findOrFail($id);

        Storage::delete('public/reports/user'. $user->id . '/'. $report->photo);

        $report->delete();

        return redirect()->route('reports.index');
    }*/
}
