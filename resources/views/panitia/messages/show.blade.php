@extends('layouts.tailwind')
@section('title', 'Pesan')
@section('page', 'Pesan - ' . $sponsorship->company->nama_perusahaan)

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 flex flex-col h-[600px]">

        {{-- Header --}}
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-gray-900">{{ $sponsorship->company->nama_perusahaan ?? $sponsorship->event->nama_event }}</h2>
                <p class="text-xs text-gray-400">{{ $sponsorship->event->nama_event }}</p>
            </div>
            <a href="{{ route('panitia.messages.index') }}" class="text-sm text-gray-500 hover:text-gray-700 transition">Kembali</a>
        </div>

        {{-- Messages --}}
        <div class="flex-1 overflow-y-auto px-6 py-4 space-y-4">
            @forelse($messages as $msg)
                <div class="flex {{ auth()->check() && $msg->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                    <div class="max-w-[75%] {{ auth()->check() && $msg->sender_id === auth()->id()
                        ? 'bg-indigo-600 text-white rounded-2xl rounded-br-md'
                        : 'bg-gray-100 text-gray-900 rounded-2xl rounded-bl-md' }} px-4 py-2.5">
                        <p class="text-sm">{{ $msg->message }}</p>
                        <p class="text-xs mt-1 {{ auth()->check() && $msg->sender_id === auth()->id() ? 'text-indigo-200' : 'text-gray-400' }}">
                            {{ $msg->created_at->format('H:i, d M') }}
                        </p>
                    </div>
                </div>
            @empty
                <div class="text-center py-8 text-gray-400 text-sm">Belum ada pesan. Kirim pesan pertama!</div>
            @endforelse
        </div>

        {{-- Input --}}
        @auth
        <div class="px-6 py-4 border-t border-gray-100">
            <form method="POST" action="{{ route('panitia.messages.store', $sponsorship) }}">
                @csrf
                <div class="flex gap-2">
                    <input type="text" name="message" placeholder="Tulis pesan..." required
                           class="flex-1 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <button type="submit" class="px-5 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                        Kirim
                    </button>
                </div>
            </form>
        </div>
        @endauth
    </div>
</div>
@endsection
