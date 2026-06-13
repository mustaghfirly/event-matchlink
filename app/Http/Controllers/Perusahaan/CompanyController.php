<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $company = Auth::user()->company;

        if (!$company) {
            return redirect()->route('perusahaan.company.create');
        }

        return view('perusahaan.company.show', compact('company'));
    }

    public function create()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $company = Auth::user()->company;

        if ($company) {
            return redirect()->route('perusahaan.company.index');
        }

        return view('perusahaan.company.create');
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $request->validate([
            'nama_perusahaan' => 'required',
            'bidang'          => 'required',
            'deskripsi'       => 'nullable',
            'logo'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'website'         => 'nullable|url',
            'email_perusahaan'=> 'nullable|email',
            'telepon'         => 'nullable',
            'alamat'          => 'nullable',
        ]);

        $logoPath = null;

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        Company::create([
            'user_id'          => Auth::id(),
            'nama_perusahaan'  => $request->nama_perusahaan,
            'bidang'           => $request->bidang,
            'deskripsi'        => $request->deskripsi,
            'logo'             => $logoPath,
            'website'          => $request->website,
            'email_perusahaan' => $request->email_perusahaan,
            'telepon'          => $request->telepon,
            'alamat'           => $request->alamat,
        ]);

        return redirect()
            ->route('perusahaan.company.index')
            ->with('success', 'Profil perusahaan berhasil dibuat');
    }

    public function edit()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $company = Auth::user()->company;

        if (!$company) {
            return redirect()->route('perusahaan.company.create');
        }

        return view('perusahaan.company.edit', compact('company'));
    }

    public function update(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $company = Auth::user()->company;

        if (!$company) {
            return redirect()->route('perusahaan.company.create');
        }

        $request->validate([
            'nama_perusahaan' => 'required',
            'bidang'          => 'required',
            'deskripsi'       => 'nullable',
            'logo'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'website'         => 'nullable|url',
            'email_perusahaan'=> 'nullable|email',
            'telepon'         => 'nullable',
            'alamat'          => 'nullable',
        ]);

        $logoPath = $company->logo;

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        $company->update([
            'nama_perusahaan'  => $request->nama_perusahaan,
            'bidang'           => $request->bidang,
            'deskripsi'        => $request->deskripsi,
            'logo'             => $logoPath,
            'website'          => $request->website,
            'email_perusahaan' => $request->email_perusahaan,
            'telepon'          => $request->telepon,
            'alamat'           => $request->alamat,
        ]);

        return redirect()
            ->route('perusahaan.company.index')
            ->with('success', 'Profil perusahaan berhasil diupdate');
    }
}
