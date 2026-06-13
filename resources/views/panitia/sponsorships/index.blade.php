@extends('layouts.tailwind')
@section('title', 'Pengajuan Saya')
@section('page', 'Pengajuan Sponsorship')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Pengajuan Sponsorship</h1>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <p class="text-sm font-medium text-gray-500">Pending</p>
        <p class="text-3xl font-bold text-amber-500 mt-1">{{ $pendingCount }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <p class="text-sm font-medium text-gray-500">Diterima</p>
        <p class="text-3xl font-bold text-emerald-600 mt-1">{{ $acceptedCount }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <p class="text-sm font-medium text-gray-500">Ditolak</p>
        <p class="text-3xl font-bold text-red-600 mt-1">{{ $rejectedCount }}</p>
    </div>
</div>

<div class="space-y-3">
    @forelse($sponsorships as $sponsorship)
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
        <div class="flex items-start justify-between">
            <div>
                <h3 class="font-semibold text-gray-900">{{ $sponsorship->event->nama_event }}</h3>
                <p class="text-sm text-gray-500 mt-0.5">
                    {{ $sponsorship->company->nama_perusahaan }}
                    · Rp {{ number_format($sponsorship->nominal,0,',','.') }}
                </p>
                @if($sponsorship->catatan)
                    <p class="text-sm text-gray-400 mt-1">{{ $sponsorship->catatan }}</p>
                @endif
            </div>
            <div>
                @if($sponsorship->status === 'pending')
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">Pending</span>
                @elseif($sponsorship->status === 'accepted')
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">Diterima</span>
                @else
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Ditolak</span>
                @endif
            </div>
        </div>
    </div>
    @empty
    <div class="text-center py-12 text-gray-500">
        <p>Belum ada pengajuan sponsorship.</p>
        <a href="{{ route('panitia.companies.index') }}" class="text-indigo-600 hover:text-indigo-800 font-medium mt-2 inline-block">Cari perusahaan</a>
    </div>
    @endforelse
</div>
@endsection
