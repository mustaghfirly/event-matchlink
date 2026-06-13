@extends('layouts.tailwind')
@section('title', $company->nama_perusahaan)
@section('page', 'Detail Perusahaan')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    {{-- Profile --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 text-center border-b border-gray-100">
            @if($company->logo)
                <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo" class="w-20 h-20 object-contain mx-auto mb-3">
            @else
                <div class="w-20 h-20 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center mx-auto mb-3 text-2xl font-bold">
                    {{ substr($company->nama_perusahaan, 0, 1) }}
                </div>
            @endif
            <h1 class="text-xl font-bold text-gray-900">{{ $company->nama_perusahaan }}</h1>
            <p class="text-sm text-gray-500">{{ $company->bidang }}</p>
        </div>
        <div class="p-6">
            <dl class="divide-y divide-gray-100">
                <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">Deskripsi</dt>
                    <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $company->deskripsi ?? '-' }}</dd>
                </div>
                <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">Email</dt>
                    <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $company->email_perusahaan ?? '-' }}</dd>
                </div>
                <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">Telepon</dt>
                    <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $company->telepon ?? '-' }}</dd>
                </div>
                <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">Website</dt>
                    <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">
                        @if($company->website)
                            <a href="{{ $company->website }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">{{ $company->website }}</a>
                        @else -
                        @endif
                    </dd>
                </div>
                <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">Alamat</dt>
                    <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $company->alamat ?? '-' }}</dd>
                </div>
            </dl>
        </div>
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
            <a href="{{ route('panitia.companies.index') }}" class="text-sm text-gray-500 hover:text-gray-700 transition">← Kembali</a>
        </div>
    </div>

    {{-- Ajukan Sponsorship --}}
    @auth
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Ajukan Sponsorship</h2>

        @if($events->isEmpty())
            <div class="p-4 rounded-lg bg-amber-50 border border-amber-200 text-sm text-amber-700">
                Anda belum memiliki event. <a href="{{ route('events.create') }}" class="font-medium underline">Buat event</a> terlebih dahulu.
            </div>
        @else
            <form method="POST" action="{{ route('panitia.sponsorships.store', $company) }}">
                @csrf

                @if(session('error'))
                    <div class="mb-4 p-3 rounded-lg bg-red-50 border border-red-200 text-sm text-red-700">{{ session('error') }}</div>
                @endif

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Event</label>
                        <select name="event_id" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">-- Pilih Event --</option>
                            @foreach($events as $event)
                                @php $existing = $existingSponsorships->get($event->id) @endphp
                                <option value="{{ $event->id }}" {{ old('event_id') == $event->id ? 'selected' : '' }}>
                                    {{ $event->nama_event }}
                                    @if($existing)
                                        ({{ $existing->status === 'pending' ? 'Sudah diajukan - Pending' : ($existing->status === 'accepted' ? 'Diterima' : 'Ditolak') }})
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @error('event_id')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nominal (Rp)</label>
                        <input type="number" name="nominal" value="{{ old('nominal') }}"
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('nominal')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Catatan</label>
                        <textarea name="catatan" rows="3"
                                  class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('catatan') }}</textarea>
                        @error('catatan')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>

                <button type="submit" class="mt-4 px-6 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">Ajukan Sponsorship</button>
            </form>
        @endif
    </div>
    @else
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 text-center">
        <h2 class="text-lg font-semibold text-gray-900 mb-2">Tertarik mensponsori?</h2>
        <p class="text-sm text-gray-500 mb-4">Login untuk mengajukan sponsorship ke perusahaan ini.</p>
        <a href="{{ route('login') }}" class="inline-flex px-6 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">Login</a>
    </div>
    @endauth

</div>
@endsection
