<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use App\Models\Vote;

use Illuminate\View\View;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Request as FacadesRequest;

use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ReportController extends Controller
{
    public function create(): View
    {
        return view('user.create-report');
    }

    public function index(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $reports = Report::where('title', 'LIKE', "%{$query}%")
                            ->orWhere('description', 'LIKE', "%{$query}%")
                            ->orWhere('tag', 'LIKE', "%{$query}%")
                            ->orWhere('author', 'LIKE', "%{$query}%")
                            ->get();
        } else {
            $reports = Report::all();
        }

        return view('view-report', compact('reports', 'query'));
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

        $report = $user->reports()->create([
            'title'         => $request->title,
            'tag'           => $request->tag,
            'anonymous'     => $request->anonymous,
            'public'        => $request->public,
            'author'        => $anonymous ? 'Anonymous' : $user->name,
            'description'   => $request->description,
            'report_date'   => now()->toDateString(),
            'photo'         => $photo->hashName(),
        ]);

        return redirect()->route('user.dashboard');
    }

    public function show(string $id): View
    {
        $report = Report::findOrFail($id);
        $accessedFrom = url()->previous();
        if (strpos($accessedFrom, 'admin/dashboard') !== false) {
            return view('admin.report-details', compact('report'));
        } 
        elseif (strpos($accessedFrom, '/viewreport') !== false) {
            return view('report-details', compact('report'));
        }
        elseif (strpos($accessedFrom, 'user/dashboard') !== false) {
            return view('user.report-details', compact('report'));
        } 
        return view('report-details', compact('report'));
    }

    public function destroy($id): RedirectResponse
    {
        $user = auth()->user();

        $report = Report::findOrFail($id);

        Storage::delete('public/reports/user'. $user->id . '/'. $report->photo);

        $report->delete();
        if ($user->role == 'user') {
            return redirect()->route('user.dashboard')->with('success', 'Laporan Berhasil Dihapus!');
        }
        else {
            return redirect()->route('admin.dashboard')->with('success', 'Laporan Berhasil Dihapus!');
        }
    }

    public function vote($id)
    {
        $report = Report::findOrFail($id);
        $user = Auth::user();

        $vote = Vote::where('report_id', $report->id)->where('user_id', $user->id)->first();

        if ($vote) {
            // Unvote
            $vote->delete();
            $message = 'Unvoted successfully';
        } else {
            // Vote
            Vote::create([
                'user_id' => $user->id,
                'report_id' => $report->id,
            ]);
            $message = 'Voted successfully';
        }

        // Update vote count in the reports table
        $report->updateVoteCount();

        return response()->json(['success' => $message, 'votes_count' => $report->votes]);
    }

    public function getVotesCount($id)
    {
        $report = Report::findOrFail($id);
        $votesCount = $report->votes()->count();
        return response()->json(['votes_count' => $votesCount]);
    }

    public function download($id) {
        $report = Report::findOrFail($id);
        $pdf = PDF::loadView('reports.pdf', compact('report'));
        return $pdf->download('report_' . $report->id . '.pdf');
    }
}