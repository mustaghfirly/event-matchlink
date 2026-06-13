<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Event;
use App\Models\Sponsorship;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPanitia     = User::where('role', 'panitia')->count();
        $totalPerusahaan  = User::where('role', 'perusahaan')->count();
        $totalAdmin       = User::where('role', 'admin')->count();
        $totalEvent       = Event::count();
        $eventPending     = Event::where('status', 'pending')->count();
        $eventApproved    = Event::where('status', 'approved')->count();
        $eventRejected    = Event::where('status', 'rejected')->count();
        $totalSponsorship = Sponsorship::count();
        $sponsorshipPending  = Sponsorship::where('status', 'pending')->count();
        $sponsorshipAccepted = Sponsorship::where('status', 'accepted')->count();

        return view('admin.dashboard', compact(
            'totalPanitia', 'totalPerusahaan', 'totalAdmin',
            'totalEvent', 'eventPending', 'eventApproved', 'eventRejected',
            'totalSponsorship', 'sponsorshipPending', 'sponsorshipAccepted'
        ));
    }
}
