<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        return view('user/dashboard');
    }

    public function show($id)
    {
        // Logic to show specific user-related content
    }

    // Other actions as needed
}