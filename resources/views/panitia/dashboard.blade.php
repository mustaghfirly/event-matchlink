@extends('layouts.tailwind')
@section('title', 'Dashboard Panitia')
@section('page', 'Dashboard')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Dashboard Panitia</h1>
    @auth
    <a href="{{ route('panitia.companies.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        Cari Sponsor
    </a>
    @endauth
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Total Event</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalEvent }}</p>
            </div>
            <div class="w-12 h-12 rounded-lg bg-indigo-100 text-indigo-600 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Pending</p>
                <p class="text-3xl font-bold text-amber-500 mt-1">{{ $pendingEvent }}</p>
            </div>
            <div class="w-12 h-12 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Disetujui</p>
                <p class="text-3xl font-bold text-emerald-600 mt-1">{{ $approvedEvent }}</p>
            </div>
            <div class="w-12 h-12 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
    @auth
    <a href="{{ route('events.create') }}" class="block p-6 bg-gradient-to-r from-indigo-600 to-indigo-700 rounded-xl text-white hover:from-indigo-700 hover:to-indigo-800 transition shadow-sm">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-white/20 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            </div>
            <div>
                <p class="font-semibold">+ Tambah Event</p>
                <p class="text-sm text-indigo-200">Buat event baru untuk mencari sponsor</p>
            </div>
        </div>
    </a>
    @else
    <a href="{{ route('login') }}" class="block p-6 bg-gradient-to-r from-indigo-600 to-indigo-700 rounded-xl text-white hover:from-indigo-700 hover:to-indigo-800 transition shadow-sm">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-white/20 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            </div>
            <div>
                <p class="font-semibold">+ Tambah Event</p>
                <p class="text-sm text-indigo-200">Login untuk membuat event baru</p>
            </div>
        </div>
    </a>
    @endauth

    @auth
    <a href="{{ route('events.index') }}" class="block p-6 bg-gradient-to-r from-emerald-600 to-emerald-700 rounded-xl text-white hover:from-emerald-700 hover:to-emerald-800 transition shadow-sm">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-white/20 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </div>
            <div>
                <p class="font-semibold">Kelola Event</p>
                <p class="text-sm text-emerald-200">Lihat dan kelola semua event Anda</p>
            </div>
        </div>
    </a>
    @else
    <a href="{{ route('events.index') }}" class="block p-6 bg-gradient-to-r from-emerald-600 to-emerald-700 rounded-xl text-white hover:from-emerald-700 hover:to-emerald-800 transition shadow-sm">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-white/20 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </div>
            <div>
                <p class="font-semibold">Lihat Event</p>
                <p class="text-sm text-emerald-200">Jelajahi event-event yang tersedia</p>
            </div>
        </div>
    </a>
    @endauth
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
    <h2 class="text-lg font-semibold text-gray-900 mb-2">Akses Cepat</h2>
    <div class="flex flex-wrap gap-3">
        <a href="{{ route('panitia.sponsorships.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-amber-50 text-amber-700 rounded-lg text-sm font-medium hover:bg-amber-100 transition">
            📄 Pengajuan Saya
        </a>
        <a href="{{ route('panitia.messages.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 text-blue-700 rounded-lg text-sm font-medium hover:bg-blue-100 transition">
            💬 Pesan
        </a>
    </div>
</div>
@endsection
