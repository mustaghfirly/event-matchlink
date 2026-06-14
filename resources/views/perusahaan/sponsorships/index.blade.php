@extends('layouts.tailwind')
@section('title', 'Permohonan Sponsorship')
@section('page', 'Permohonan Masuk')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Permohonan Sponsorship</h1>
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
                    {{ $sponsorship->event->user->name }}
                    · {{ $sponsorship->event->kategori }}
                    · Rp {{ number_format($sponsorship->nominal,0,',','.') }}
                </p>
                @if($sponsorship->catatan)
                    <p class="text-sm text-gray-400 mt-1">{{ $sponsorship->catatan }}</p>
                @endif
            </div>
            <div class="flex items-center gap-2">
                @if($sponsorship->status === 'pending')
                    @auth
                    <form method="POST" action="{{ route('perusahaan.sponsorships.approve', $sponsorship) }}" class="inline">
                        @csrf @method('PATCH')
                        <button type="submit" onclick="return confirm('Terima permohonan ini?')"
                                class="px-3 py-1.5 bg-emerald-50 text-emerald-700 rounded-lg hover:bg-emerald-100 transition text-xs font-medium">Terima</button>
                    </form>
                    <form method="POST" action="{{ route('perusahaan.sponsorships.reject', $sponsorship) }}" class="inline">
                        @csrf @method('PATCH')
                        <button type="submit" onclick="return confirm('Tolak permohonan ini?')"
                                class="px-3 py-1.5 bg-red-50 text-red-700 rounded-lg hover:bg-red-100 transition text-xs font-medium">Tolak</button>
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="text-xs text-indigo-600 hover:text-indigo-900 font-medium">Login untuk merespons →</a>
                    @endauth
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
        <p>Belum ada permohonan sponsorship masuk.</p>
    </div>
    @endforelse
</div>
@if(method_exists($sponsorships, 'links'))
    <div class="mt-6">
        {{ $sponsorships->links() }}
    </div>
@endif
@endsection
