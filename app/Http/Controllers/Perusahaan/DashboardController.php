<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $events = Event::latest()->get();
        $company = Auth::check() ? Auth::user()->company : null;

        return view('perusahaan.dashboard', compact('events', 'company'));
    }
}
