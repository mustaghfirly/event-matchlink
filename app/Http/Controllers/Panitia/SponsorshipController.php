<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Sponsorship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SponsorshipController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return view('panitia.sponsorships.index', [
                'sponsorships' => collect(),
                'pendingCount' => 0,
                'acceptedCount' => 0,
                'rejectedCount' => 0,
            ]);
        }

        $baseQuery = Sponsorship::whereHas('event', function ($q) {
            $q->where('user_id', Auth::id());
        });

        $pendingCount  = (clone $baseQuery)->where('status', 'pending')->count();
        $acceptedCount = (clone $baseQuery)->where('status', 'accepted')->count();
        $rejectedCount = (clone $baseQuery)->where('status', 'rejected')->count();

        $sponsorships = (clone $baseQuery)
            ->with(['event', 'company'])
            ->latest()
            ->paginate(10);

        return view('panitia.sponsorships.index', compact(
            'sponsorships',
            'pendingCount',
            'acceptedCount',
            'rejectedCount'
        ));
    }

    public function store(Request $request, Company $company)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $request->validate([
            'event_id' => 'required|exists:events,id',
            'nominal'  => 'required|numeric|min:0',
            'catatan'  => 'nullable',
        ]);

        $event = \App\Models\Event::findOrFail($request->event_id);

        if ($event->user_id !== Auth::id()) {
            abort(403);
        }

        $exists = Sponsorship::where('event_id', $event->id)
            ->where('company_id', $company->id)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->with('error', 'Anda sudah mengajukan sponsorship ke perusahaan ini untuk event tersebut');
        }

        Sponsorship::create([
            'event_id'   => $event->id,
            'company_id' => $company->id,
            'nominal'    => $request->nominal,
            'catatan'    => $request->catatan,
            'status'     => 'pending',
        ]);

        return redirect()
            ->route('panitia.sponsorships.index')
            ->with('success', 'Pengajuan sponsorship berhasil dikirim');
    }
}
