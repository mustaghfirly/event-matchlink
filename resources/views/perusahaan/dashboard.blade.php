@extends('layouts.tailwind')
@section('title', 'Dashboard Perusahaan')
@section('page', 'Dashboard')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Dashboard Perusahaan</h1>
    <div class="flex items-center gap-2">
        @auth
            @if($company)
                <a href="{{ route('perusahaan.company.index') }}" class="inline-flex items-center gap-1 px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Profil
                </a>
                <a href="{{ route('perusahaan.sponsorships.index') }}" class="inline-flex items-center gap-1 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                    Permohonan Masuk
                </a>
            @else
                <a href="{{ route('perusahaan.company.create') }}" class="inline-flex items-center gap-1 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                    Lengkapi Profil
                </a>
            @endif
        @endauth
    </div>
</div>

@auth
    @if(!$company)
        <div class="mb-6 p-4 rounded-lg bg-amber-50 border border-amber-200 text-sm text-amber-700">
            <a href="{{ route('perusahaan.company.create') }}" class="font-medium underline">Lengkapi profil perusahaan</a> agar panitia bisa mengajukan sponsorship.
        </div>
    @endif
@endauth

<h2 class="text-lg font-semibold text-gray-900 mb-4">Daftar Event</h2>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @forelse($events as $event)
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">
        <div class="p-5">
            <h3 class="font-semibold text-gray-900">
                <a href="{{ route('perusahaan.events.show', $event) }}" class="hover:text-indigo-600 transition">{{ $event->nama_event }}</a>
            </h3>
            <div class="mt-3 space-y-1 text-sm text-gray-500">
                <p><span class="font-medium text-gray-700">Kategori:</span> {{ $event->kategori }}</p>
                <p><span class="font-medium text-gray-700">Target:</span> Rp {{ number_format($event->target_dana,0,',','.') }}</p>
                <p><span class="font-medium text-gray-700">Lokasi:</span> {{ $event->lokasi }}</p>
            </div>
            <div class="mt-3 flex items-center justify-between">
                @if($event->status === 'pending')
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">Pending</span>
                @elseif($event->status === 'approved')
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">Disetujui</span>
                @else
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Ditolak</span>
                @endif
                <a href="{{ route('perusahaan.events.show', $event) }}" class="text-xs text-indigo-600 hover:text-indigo-900 font-medium">Detail →</a>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-full text-center py-12 text-gray-500">
        <p>Belum ada event.</p>
    </div>
    @endforelse
</div>
@endsection
