@extends('layouts.tailwind')
@section('title', 'Edit Profil')
@section('page', 'Profil Perusahaan')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="text-lg font-semibold text-gray-900">Edit Profil Perusahaan</h2>
        </div>
        <div class="p-6">
            <form method="POST" action="{{ route('perusahaan.company.update') }}" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <label for="nama_perusahaan" class="block text-sm font-medium text-gray-700">Nama Perusahaan</label>
                        <input type="text" name="nama_perusahaan" id="nama_perusahaan" value="{{ old('nama_perusahaan', $company->nama_perusahaan) }}"
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('nama_perusahaan') border-red-300 @enderror">
                        @error('nama_perusahaan')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div class="md:col-span-2">
                        <label for="bidang" class="block text-sm font-medium text-gray-700">Bidang</label>
                        <input type="text" name="bidang" id="bidang" value="{{ old('bidang', $company->bidang) }}"
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('bidang') border-red-300 @enderror">
                        @error('bidang')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div class="md:col-span-2">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4"
                                  class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('deskripsi') border-red-300 @enderror">{{ old('deskripsi', $company->deskripsi) }}</textarea>
                        @error('deskripsi')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="email_perusahaan" class="block text-sm font-medium text-gray-700">Email Perusahaan</label>
                        <input type="email" name="email_perusahaan" id="email_perusahaan" value="{{ old('email_perusahaan', $company->email_perusahaan) }}"
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('email_perusahaan') border-red-300 @enderror">
                        @error('email_perusahaan')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="telepon" class="block text-sm font-medium text-gray-700">Telepon</label>
                        <input type="text" name="telepon" id="telepon" value="{{ old('telepon', $company->telepon) }}"
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('telepon') border-red-300 @enderror">
                        @error('telepon')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div class="md:col-span-2">
                        <label for="website" class="block text-sm font-medium text-gray-700">Website</label>
                        <input type="url" name="website" id="website" value="{{ old('website', $company->website) }}"
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('website') border-red-300 @enderror">
                        @error('website')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div class="md:col-span-2">
                        <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <textarea name="alamat" id="alamat" rows="3"
                                  class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('alamat') border-red-300 @enderror">{{ old('alamat', $company->alamat) }}</textarea>
                        @error('alamat')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div class="md:col-span-2">
                        <label for="logo" class="block text-sm font-medium text-gray-700">Logo Perusahaan</label>
                        @if($company->logo)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo" class="h-16 w-16 object-contain rounded-full border border-gray-200">
                            </div>
                        @endif
                        <input type="file" name="logo" id="logo"
                               class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 @error('logo') border-red-300 @enderror">
                        @error('logo')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="mt-6 flex gap-3">
                    <button type="submit" class="px-5 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">Update</button>
                    <a href="{{ route('perusahaan.company.index') }}" class="px-5 py-2.5 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
