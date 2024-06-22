<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin/dashboard');
    }

    public function show($id)
    {
        // Logic to show specific admin-related content
    }

    // Other actions as needed
}
