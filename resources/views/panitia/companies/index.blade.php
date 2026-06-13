@extends('layouts.tailwind')
@section('title', 'Cari Sponsor')
@section('page', 'Cari Sponsor')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Cari Sponsor</h1>
    <a href="{{ route('panitia.dashboard') }}" class="text-sm text-gray-500 hover:text-gray-700 transition">Kembali</a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @forelse($companies as $c)
    <a href="{{ route('panitia.companies.show', $c) }}" class="block bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition p-6">
        <div class="text-center">
            @if($c->logo)
                <img src="{{ asset('storage/' . $c->logo) }}" alt="Logo" class="w-16 h-16 object-contain mx-auto mb-3">
            @else
                <div class="w-16 h-16 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center mx-auto mb-3 text-xl font-bold">
                    {{ substr($c->nama_perusahaan, 0, 1) }}
                </div>
            @endif
            <h3 class="font-semibold text-gray-900">{{ $c->nama_perusahaan }}</h3>
            <p class="text-sm text-gray-500 mt-0.5">{{ $c->bidang }}</p>
            @if($c->deskripsi)
                <p class="text-xs text-gray-400 mt-2">{{ Str::limit($c->deskripsi, 80) }}</p>
            @endif
        </div>
    </a>
    @empty
    <div class="col-span-full text-center py-12 text-gray-500">
        <p>Belum ada perusahaan yang mendaftar.</p>
    </div>
    @endforelse
</div>
@endsection
