@extends('layouts.tailwind')
@section('title', 'Dashboard Admin')
@section('page', 'Dashboard')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Dashboard Admin</h1>
</div>

<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl shadow-sm p-6 text-white">
        <p class="text-sm font-medium text-indigo-100">Panitia</p>
        <p class="text-3xl font-bold mt-1">{{ $totalPanitia }}</p>
    </div>
    <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl shadow-sm p-6 text-white">
        <p class="text-sm font-medium text-emerald-100">Perusahaan</p>
        <p class="text-3xl font-bold mt-1">{{ $totalPerusahaan }}</p>
    </div>
    <div class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl shadow-sm p-6 text-white">
        <p class="text-sm font-medium text-amber-100">Admin</p>
        <p class="text-3xl font-bold mt-1">{{ $totalAdmin }}</p>
    </div>
    <div class="bg-gradient-to-br from-gray-700 to-gray-800 rounded-xl shadow-sm p-6 text-white">
        <p class="text-sm font-medium text-gray-300">Total User</p>
        <p class="text-3xl font-bold mt-1">{{ $totalPanitia + $totalPerusahaan + $totalAdmin }}</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <p class="text-sm font-medium text-gray-500">Total Event</p>
        <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalEvent }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <p class="text-sm font-medium text-gray-500">Event Pending</p>
        <p class="text-3xl font-bold text-amber-500 mt-1">{{ $eventPending }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <p class="text-sm font-medium text-gray-500">Event Disetujui</p>
        <p class="text-3xl font-bold text-emerald-600 mt-1">{{ $eventApproved }}</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <p class="text-sm font-medium text-gray-500">Total Sponsorship</p>
        <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalSponsorship }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <p class="text-sm font-medium text-gray-500">Sponsorship Pending</p>
        <p class="text-3xl font-bold text-amber-500 mt-1">{{ $sponsorshipPending }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <p class="text-sm font-medium text-gray-500">Sponsorship Accepted</p>
        <p class="text-3xl font-bold text-emerald-600 mt-1">{{ $sponsorshipAccepted }}</p>
    </div>
</div>

<div class="flex gap-3">
    <a href="{{ route('admin.users.index') }}" class="px-5 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">Kelola User</a>
    <a href="{{ route('admin.events.index') }}" class="px-5 py-2.5 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700 transition">Kelola Event</a>
</div>
@endsection
