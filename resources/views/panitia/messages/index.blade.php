@extends('layouts.tailwind')
@section('title', 'Pesan')
@section('page', 'Pesan')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Pesan</h1>
</div>

@if($unreadCount > 0)
    <div class="mb-4 p-4 rounded-lg bg-blue-50 border border-blue-200 text-sm text-blue-700">
        Anda memiliki <strong>{{ $unreadCount }}</strong> pesan belum dibaca.
    </div>
@endif

<div class="space-y-2">
    @forelse($sponsorships as $sponsorship)
        @php
            $lastMsg = $sponsorship->messages()->latest()->first();
            $unread = $sponsorship->messages()->where('receiver_id', auth()->id())->where('is_read', false)->exists();
        @endphp
        <a href="{{ route('panitia.messages.show', $sponsorship) }}"
           class="block bg-white rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-md transition {{ $unread ? 'ring-2 ring-indigo-200' : '' }}">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="font-semibold {{ $unread ? 'text-gray-900' : 'text-gray-700' }}">{{ $sponsorship->company->nama_perusahaan }}</h3>
                    <p class="text-xs text-gray-400">{{ $sponsorship->event->nama_event }}</p>
                </div>
                <div class="text-right">
                    @if($unread)
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-700">Baru</span>
                    @endif
                    @if($lastMsg)
                        <p class="text-xs text-gray-400 mt-1">{{ $lastMsg->created_at->diffForHumans() }}</p>
                    @endif
                </div>
            </div>
            @if($lastMsg)
                <p class="text-sm text-gray-500 mt-2 truncate">{{ $lastMsg->message }}</p>
            @endif
        </a>
    @empty
        <div class="text-center py-12 text-gray-500">
            <p>Belum ada percakapan.</p>
            <a href="{{ route('panitia.companies.index') }}" class="text-indigo-600 hover:text-indigo-800 font-medium mt-2 inline-block">Cari perusahaan</a>
        </div>
    @endforelse
</div>
@if(method_exists($sponsorships, 'links'))
    <div class="mt-6">
        {{ $sponsorships->links() }}
    </div>
@endif
@endsection
