<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

final class DashboardController extends Controller
{
    /**
     * Display the Dashboard view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('dashboard');
    }
}
