@extends('layouts.tailwind')
@section('title', 'Profil Perusahaan')
@section('page', 'Profil Perusahaan')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-900">Profil Perusahaan</h2>
            @auth
            <a href="{{ route('perusahaan.company.edit') }}" class="px-4 py-2 bg-amber-50 text-amber-700 text-sm font-medium rounded-lg hover:bg-amber-100 transition">Edit Profil</a>
            @endauth
        </div>
        <div class="p-6">
            <div class="text-center mb-6">
                @if($company->logo)
                    <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo" class="mx-auto h-24 w-24 object-contain rounded-full border border-gray-200">
                @else
                    <div class="mx-auto h-24 w-24 rounded-full bg-gray-100 flex items-center justify-center text-gray-400 text-sm">Belum ada logo</div>
                @endif
                <h3 class="mt-3 text-xl font-bold text-gray-900">{{ $company->nama_perusahaan }}</h3>
                <p class="text-sm text-gray-500">{{ $company->bidang }}</p>
            </div>
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
                    <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm">
                        @if($company->website)
                            <a href="{{ $company->website }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">{{ $company->website }}</a>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </dd>
                </div>
                <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">Alamat</dt>
                    <dd class="mt-1 sm:mt-0 sm:col-span-2 text-sm text-gray-900">{{ $company->alamat ?? '-' }}</dd>
                </div>
            </dl>
        </div>
    </div>
</div>
@endsection
