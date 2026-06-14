<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use App\Models\Sponsorship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SponsorshipController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return view('perusahaan.sponsorships.index', [
                'sponsorships' => collect(),
                'pendingCount' => 0,
                'acceptedCount' => 0,
                'rejectedCount' => 0,
            ]);
        }

        $company = Auth::user()->company;

        if (!$company) {
            return redirect()->route('perusahaan.company.create')
                ->with('success', 'Lengkapi profil perusahaan terlebih dahulu');
        }

        $baseQuery = Sponsorship::where('company_id', $company->id);

        $pendingCount  = (clone $baseQuery)->where('status', 'pending')->count();
        $acceptedCount = (clone $baseQuery)->where('status', 'accepted')->count();
        $rejectedCount = (clone $baseQuery)->where('status', 'rejected')->count();

        $sponsorships = (clone $baseQuery)
            ->with(['event', 'event.user'])
            ->latest()
            ->paginate(10);

        return view('perusahaan.sponsorships.index', compact(
            'sponsorships',
            'pendingCount',
            'acceptedCount',
            'rejectedCount'
        ));
    }

    public function approve(Sponsorship $sponsorship)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $company = Auth::user()->company;

        if (!$company || $sponsorship->company_id !== $company->id) {
            abort(403);
        }

        $sponsorship->update(['status' => 'accepted']);

        return redirect()
            ->route('perusahaan.sponsorships.index')
            ->with('success', 'Sponsorship diterima');
    }

    public function reject(Sponsorship $sponsorship)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $company = Auth::user()->company;

        if (!$company || $sponsorship->company_id !== $company->id) {
            abort(403);
        }

        $sponsorship->update(['status' => 'rejected']);

        return redirect()
            ->route('perusahaan.sponsorships.index')
            ->with('success', 'Sponsorship ditolak');
    }
}
