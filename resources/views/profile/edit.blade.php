@extends('layouts.tailwind')
@section('title', 'Profil')
@section('page', 'Pengaturan Profil')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    {{-- Profile Information --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="text-lg font-semibold text-gray-900">Informasi Profil</h2>
            <p class="text-sm text-gray-500 mt-0.5">Perbarui informasi akun kamu</p>
        </div>
        <div class="p-6">
            <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
                @csrf
                @method('patch')

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('name') border-red-300 @enderror">
                    @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('email') border-red-300 @enderror">
                    @error('email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('phone') border-red-300 @enderror">
                    @error('phone')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Role</label>
                    <div class="mt-1">
                        @php
                            $roleBadge = $user->role === 'admin' ? 'bg-red-100 text-red-800' : ($user->role === 'panitia' ? 'bg-blue-100 text-blue-800' : 'bg-emerald-100 text-emerald-800');
                        @endphp
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $roleBadge }}">{{ ucfirst($user->role) }}</span>
                    </div>
                </div>

                <div class="flex items-center gap-4 pt-2">
                    <button type="submit" class="px-5 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">Simpan</button>
                    @if (session('status') === 'profile-updated')
                        <p x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"
                           class="text-sm text-emerald-600 font-medium">Tersimpan!</p>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- Update Password --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="text-lg font-semibold text-gray-900">Reset Password</h2>
            <p class="text-sm text-gray-500 mt-0.5">Pastikan password akun kamu aman</p>
        </div>
        <div class="p-6">
            <form method="post" action="{{ route('password.update') }}" class="space-y-4">
                @csrf
                @method('put')

                <div>
                    <label for="update_password_current_password" class="block text-sm font-medium text-gray-700">Password Saat Ini</label>
                    <input type="password" name="current_password" id="update_password_current_password" required
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('current_password', 'updatePassword') border-red-300 @enderror">
                    @error('current_password', 'updatePassword')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="update_password_password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                    <input type="password" name="password" id="update_password_password" required
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('password', 'updatePassword') border-red-300 @enderror">
                    @error('password', 'updatePassword')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="update_password_password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" id="update_password_password_confirmation" required
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div class="flex items-center gap-4 pt-2">
                    <button type="submit" class="px-5 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">Simpan Password</button>
                    @if (session('status') === 'password-updated')
                        <p x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"
                           class="text-sm text-emerald-600 font-medium">Tersimpan!</p>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- Delete Account --}}
    <div class="bg-white rounded-xl shadow-sm border border-red-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-red-100 bg-red-50">
            <h2 class="text-lg font-semibold text-red-900">Hapus Akun</h2>
            <p class="text-sm text-red-600 mt-0.5">Setelah akun dihapus, semua data tidak bisa dikembalikan</p>
        </div>
        <div class="p-6">
            <p class="text-sm text-gray-500 mb-4">Hapus akun dan semua data terkait secara permanen.</p>
            <button type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                    class="px-5 py-2.5 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition">Hapus Akun</button>
        </div>
    </div>
</div>

{{-- Delete Confirmation Modal --}}
<div x-data="{ show: false }" x-show="show" x-cloak
     x-on:open-modal.window="if ($event.detail === 'confirm-user-deletion') show = true"
     x-on:close.window="show = false"
     x-on:keydown.escape.window="show = false"
     class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div x-show="show" x-cloak x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-gray-900/50" @click="show = false">
        </div>
        <div x-show="show" x-cloak x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4"
             class="relative bg-white rounded-xl shadow-xl max-w-md w-full p-6 z-10">
            <h3 class="text-lg font-semibold text-gray-900">Yakin hapus akun?</h3>
            <p class="text-sm text-gray-500 mt-2">Setelah dihapus, semua data tidak bisa dikembalikan. Masukkan password untuk konfirmasi.</p>
            <form method="post" action="{{ route('profile.destroy') }}" class="mt-4">
                @csrf
                @method('delete')
                <div>
                    <label for="delete-password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="delete-password" required
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('password', 'userDeletion') border-red-300 @enderror">
                    @error('password', 'userDeletion')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div class="flex justify-end gap-3 mt-4">
                    <button type="button" @click="show = false"
                            class="px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition">Batal</button>
                    <button type="submit"
                            class="px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition">Hapus Akun</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection