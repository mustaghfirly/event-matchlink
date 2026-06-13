<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use App\Models\Event;

class DashboardController extends Controller
{
    public function index()
    {
        $events = Event::latest()->get();

        return view('perusahaan.dashboard', compact('events'));
    }
}