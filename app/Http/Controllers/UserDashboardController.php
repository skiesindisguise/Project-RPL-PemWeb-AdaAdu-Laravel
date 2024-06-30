<?php

namespace App\Http\Controllers;
use App\Models\Report;

use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
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

        return view('user.dashboard', compact('reports', 'query'));
    }

    public function show($id)
    {
        $report = Report::findOrFail($id);
        return view('user.report-details', compact('report'));
    }

    // Other actions as needed
}