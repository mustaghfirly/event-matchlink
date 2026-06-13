@extends('layouts.tailwind')
@section('title', $event->nama_event)
@section('page', 'Detail Event')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-900">{{ $event->nama_event }}</h2>
            <a href="{{ route('admin.events.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Kembali</a>
        </div>
        <div class="p-6">
            <dl class="divide-y divide-gray-100">
                <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">Penyelenggara</dt>
                    <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $event->user->name }} ({{ $event->user->email }})</dd>
                </div>
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
                           class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">Lihat Proposal</a>
                    </dd>
                </div>
                @endif
            </dl>
        </div>
    </div>
</div>
@endsection
