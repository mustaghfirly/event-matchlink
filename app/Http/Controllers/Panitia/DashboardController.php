<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEvent = Event::where('user_id', Auth::id())->count();

        $pendingEvent = Event::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->count();

        $approvedEvent = Event::where('user_id', Auth::id())
            ->where('status', 'approved')
            ->count();

        return view('panitia.dashboard', compact(
            'totalEvent',
            'pendingEvent',
            'approvedEvent'
        ));
    }
}