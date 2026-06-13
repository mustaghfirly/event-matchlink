@extends('layouts.tailwind')
@section('title', $event->nama_event)
@section('page', 'Detail Event')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <div class="flex items-center justify-between">
                <h1 class="text-xl font-bold text-gray-900">{{ $event->nama_event }}</h1>
                <div class="flex items-center gap-2">
                    @auth
                    <a href="{{ route('events.edit', $event) }}" class="px-3 py-1.5 bg-amber-50 text-amber-700 rounded-lg hover:bg-amber-100 transition text-sm font-medium">Edit</a>
                    @endauth
                    <a href="{{ route('events.index') }}" class="px-3 py-1.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition text-sm font-medium">Kembali</a>
                </div>
            </div>
        </div>

        <div class="p-6">
            <dl class="divide-y divide-gray-100">
                <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">Kategori</dt>
                    <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $event->kategori }}</dd>
                </div>
                <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">Deskripsi</dt>
                    <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $event->deskripsi }}</dd>
                </div>
                <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">Target Dana</dt>
                    <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">Rp {{ number_format($event->target_dana,0,',','.') }}</dd>
                </div>
                <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">Tanggal Event</dt>
                    <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $event->tanggal_event }}</dd>
                </div>
                <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">Lokasi</dt>
                    <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $event->lokasi }}</dd>
                </div>
                <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                    <dd class="mt-1 sm:mt-0 sm:col-span-2">
                        @if($event->status === 'pending')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">Pending</span>
                        @elseif($event->status === 'approved')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">Disetujui</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Ditolak</span>
                        @endif
                    </dd>
                </div>
                @if($event->proposal)
                <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">Proposal</dt>
                    <dd class="mt-1 sm:mt-0 sm:col-span-2">
                        <a href="{{ asset('storage/' . $event->proposal) }}" target="_blank"
                           class="inline-flex items-center gap-1 text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Lihat Proposal
                        </a>
                    </dd>
                </div>
                @endif
            </dl>
        </div>
    </div>
</div>
@endsection
