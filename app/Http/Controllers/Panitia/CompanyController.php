<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::with('user')->latest()->paginate(10);

        return view('panitia.companies.index', compact('companies'));
    }

    public function show(Company $company)
    {
        if (!Auth::check()) {
            $events = collect();
            $existingSponsorships = collect();
        } else {
            $events = Event::where('user_id', Auth::id())->latest()->get();
            $existingSponsorships = \App\Models\Sponsorship::where('company_id', $company->id)
                ->whereIn('event_id', $events->pluck('id'))
                ->get()
                ->keyBy('event_id');
        }

        return view('panitia.companies.show', compact('company', 'events', 'existingSponsorships'));
    }
}
