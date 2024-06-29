<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminDashboardController extends Controller
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

        return view('admin.dashboard', compact('reports', 'query'));
    }

    public function show($id)
    {
        $report = Report::findOrFail($id);
        return view('admin.reportdetails', compact('report'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
            'status_desc' => 'nullable|string',
        ]);

        $report = Report::findOrFail($id);

        // Debug logs
        Log::info('Updating report', [
            'id' => $id,
            'status' => $request->status,
            'status_desc' => $request->status_desc
        ]);

        $report->status = $request->status;
        $report->status_desc = $request->status_desc;
        $report->save();

        return response()->json(['success' => 'Report updated successfully']);
    }

    public function showUmum($id)
    {
        $report = Report::findOrFail($id);
        return view('reportdetails-umum', compact('report'));
    }

}
