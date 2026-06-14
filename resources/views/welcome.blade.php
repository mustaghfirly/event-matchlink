<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventMatchLink</title>
    <link rel="icon" href="{{ asset('images/logo_event_matchlink.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-50" x-data="{ showModal: false }">

    {{-- Navbar --}}
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="h-16 flex items-center justify-between">
                <a href="/" class="flex items-center gap-2">
                    <img src="{{ asset('images/logo_event_matchlink.png') }}" alt="EventMatchLink" class="h-8">
                    <span class="text-xl font-bold text-indigo-600">Event<span class="text-gray-400 font-light">Match</span>Link</span>
                </a>
                <div class="flex items-center gap-3">
                    <a href="{{ route('login') }}" class="px-5 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600 transition">Masuk</a>
                    <a href="{{ route('register') }}" class="px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition shadow-sm">Daftar</a>
                </div>
            </div>
        </div>
    </nav>

    {{-- Hero Section --}}
    <section class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight">
                    Temukan Sponsor <span class="text-indigo-600">Terbaik</span><br>untuk Event Anda
                </h1>
                <p class="mt-6 text-lg sm:text-xl text-gray-500 leading-relaxed">
                    Platform yang menghubungkan penyelenggara event dengan perusahaan
                    pencari peluang sponsorship. Satu platform untuk semua kebutuhan
                    kerjasama Anda.
                </p>
                <div class="mt-10 flex items-center justify-center gap-4">
                    <button @click="showModal = true" class="px-8 py-3.5 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition shadow-md">Mulai Sekarang</button>
                    <a href="{{ route('login') }}" class="px-8 py-3.5 bg-gray-100 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition">Masuk</a>
                </div>
            </div>
        </div>
    </section>

    {{-- Fitur Section --}}
    <section class="py-16 lg:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Kenapa EventMatchLink?</h2>
                <p class="mt-3 text-gray-500 text-lg">Kemudahan dalam setiap tahap kerjasama sponsorship</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Buat & Kelola Event</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Panitia dapat membuat event lengkap dengan proposal, target dana, dan kategori yang jelas.</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Ajukan Sponsorship</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Ajukan pendanaan ke perusahaan yang sesuai dengan bidang event Anda secara langsung.</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Diskusi & Kolaborasi</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Setelah sponsorship diterima, diskusikan detail kerjasama melalui chat terintegrasi.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Cara Kerja --}}
    <section class="py-16 lg:py-24 bg-white border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Bagaimana Cara Kerjanya?</h2>
                <p class="mt-3 text-gray-500 text-lg">Tiga langkah mudah untuk memulai kerjasama sponsorship</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-indigo-600 text-white rounded-2xl flex items-center justify-center mx-auto mb-4 text-xl font-bold shadow-md">1</div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Daftar & Buat Profil</h3>
                    <p class="text-gray-500 text-sm">Daftar sebagai Panitia atau Perusahaan, lengkapi profil Anda.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-indigo-600 text-white rounded-2xl flex items-center justify-center mx-auto mb-4 text-xl font-bold shadow-md">2</div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Ajukan atau Terima</h3>
                    <p class="text-gray-500 text-sm">Panitia mengajukan sponsorship ke perusahaan, perusahaan menyetujui atau menolak.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-indigo-600 text-white rounded-2xl flex items-center justify-center mx-auto mb-4 text-xl font-bold shadow-md">3</div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Kolaborasi & Sukses</h3>
                    <p class="text-gray-500 text-sm">Setelah disetujui, diskusikan detail kerjasama dan wujudkan event Anda.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-16 lg:py-24">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Siap Memulai?</h2>
            <p class="text-gray-500 text-lg mb-8">Gabung sekarang dan temukan sponsorship yang tepat untuk event Anda.</p>
            <a href="{{ route('register') }}" class="px-8 py-3.5 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition shadow-md inline-block">Daftar Gratis</a>
        </div>
    </section>

    {{-- Modal Pilih Role --}}
    <div x-show="showModal" x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center p-4"
         @keydown.escape.window="showModal = false">
        <div class="fixed inset-0 bg-gray-900/50" @click="showModal = false"></div>
        <div class="relative bg-white rounded-2xl shadow-xl max-w-lg w-full p-8 text-center"
             @click.outside="showModal = false">
            <button @click="showModal = false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <div class="mb-6">
                <div class="w-16 h-16 bg-indigo-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900">Anda ingin mendaftar sebagai?</h3>
                <p class="text-sm text-gray-500 mt-1">Pilih peran Anda untuk memulai</p>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <a href="{{ route('panitia.dashboard') }}"
                   class="group bg-white border-2 border-gray-200 rounded-xl p-6 hover:border-indigo-500 hover:shadow-md transition text-center">
                    <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:bg-blue-200 transition">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    </div>
                    <h4 class="font-semibold text-gray-900">Panitia</h4>
                    <p class="text-xs text-gray-500 mt-1">Saya punya event, cari sponsor</p>
                </a>
                <a href="{{ route('perusahaan.dashboard') }}"
                   class="group bg-white border-2 border-gray-200 rounded-xl p-6 hover:border-emerald-500 hover:shadow-md transition text-center">
                    <div class="w-14 h-14 bg-emerald-100 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:bg-emerald-200 transition">
                        <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                    <h4 class="font-semibold text-gray-900">Perusahaan</h4>
                    <p class="text-xs text-gray-500 mt-1">Ingin sponsori event</p>
                </a>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <footer class="bg-white border-t border-gray-200 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm text-gray-400">
            &copy; {{ date('Y') }} EventMatchLink. All rights reserved.
        </div>
    </footer>

</body>
</html>
