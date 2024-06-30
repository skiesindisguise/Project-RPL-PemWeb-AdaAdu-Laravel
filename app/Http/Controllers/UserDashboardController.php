<?php

namespace App\Http\Controllers;
use App\Models\Report;

use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        return view('user/dashboard');
    }

    public function show($id)
    {
        $report = Report::findOrFail($id);
        return view('user.report-details', compact('report'));
    }

    // Other actions as needed
}