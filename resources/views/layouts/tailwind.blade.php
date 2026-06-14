<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    <link rel="icon" href="{{ asset('images/logo_event_matchlink.png') }}">
    @vite('resources/css/app.css')
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased">

<div x-data="{ sidebarOpen: false }" class="min-h-screen flex">

    {{-- Sidebar Overlay Mobile --}}
    <div x-show="sidebarOpen" x-cloak
         class="fixed inset-0 z-40 bg-gray-900/50 lg:hidden"
         @click="sidebarOpen = false">
    </div>

    {{-- Sidebar --}}
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
           class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-200
                  transform transition-transform duration-200 ease-in-out
                  lg:translate-x-0 lg:static lg:z-auto">

        {{-- Logo --}}
        <div class="h-16 flex items-center justify-between px-6 border-b border-gray-200">
            @auth
            <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : (auth()->user()->role === 'panitia' ? route('panitia.dashboard') : route('perusahaan.dashboard')) }}" class="flex items-center gap-2">
            @else
            <a href="/" class="flex items-center gap-2">
            @endauth
                <img src="{{ asset('images/logo_event_matchlink.png') }}" alt="EventMatchLink" class="h-7">
                <span class="text-lg font-bold text-indigo-600">Event<span class="text-gray-400 font-light">Match</span>Link</span>
            </a>
            <button @click="sidebarOpen = false" class="lg:hidden text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Sidebar Nav --}}
        <nav class="px-3 py-4 space-y-1">
            @auth
                @if(auth()->user()->role === 'panitia')
                    <x-sidebar-link :href="route('panitia.dashboard')" :active="request()->routeIs('panitia.dashboard')">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        <span>Dashboard</span>
                    </x-sidebar-link>
                    <x-sidebar-link :href="route('events.index')" :active="request()->routeIs('events.*')">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                        <span>Event Saya</span>
                    </x-sidebar-link>
                    <x-sidebar-link :href="route('panitia.companies.index')" :active="request()->routeIs('panitia.companies.*')">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        <span>Cari Sponsor</span>
                    </x-sidebar-link>
                    <x-sidebar-link :href="route('panitia.sponsorships.index')" :active="request()->routeIs('panitia.sponsorships.*')">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        <span>Pengajuan Saya</span>
                    </x-sidebar-link>
                    <x-sidebar-link :href="route('panitia.messages.index')" :active="request()->routeIs('panitia.messages.*')">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        <span>Pesan</span>
                    </x-sidebar-link>
                @elseif(auth()->user()->role === 'perusahaan')
                    <x-sidebar-link :href="route('perusahaan.dashboard')" :active="request()->routeIs('perusahaan.dashboard')">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        <span>Dashboard</span>
                    </x-sidebar-link>
                    <x-sidebar-link :href="route('perusahaan.company.index')" :active="request()->routeIs('perusahaan.company.*')">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11a3.001 3.001 0 00-2.83 2"/></svg>
                        <span>Profil Perusahaan</span>
                    </x-sidebar-link>
                    <x-sidebar-link :href="route('perusahaan.sponsorships.index')" :active="request()->routeIs('perusahaan.sponsorships.*')">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        <span>Permohonan Masuk</span>
                    </x-sidebar-link>
                    <x-sidebar-link :href="route('perusahaan.messages.index')" :active="request()->routeIs('perusahaan.messages.*')">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        <span>Pesan</span>
                    </x-sidebar-link>
                @elseif(auth()->user()->role === 'admin')
                    <x-sidebar-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        <span>Dashboard</span>
                    </x-sidebar-link>
                    <x-sidebar-link :href="route('admin.events.index')" :active="request()->routeIs('admin.events.*')">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                        <span>Event</span>
                    </x-sidebar-link>
                    <x-sidebar-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/></svg>
                        <span>User</span>
                    </x-sidebar-link>
                @endif
            @else
                {{-- Guest preview nav --}}
                <div class="px-3 py-6 text-center">
                    <p class="text-sm text-gray-500 mb-4">Lihat-lihat dulu?</p>
                    <a href="{{ route('login') }}" class="block w-full px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition mb-2">Masuk</a>
                    <a href="{{ route('register') }}" class="block w-full px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition">Daftar</a>
                </div>
            @endauth
        </nav>
    </aside>

    {{-- Main Content --}}
    <div class="flex-1 flex flex-col min-w-0">

        {{-- Top Navbar --}}
        <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-4 lg:px-6 sticky top-0 z-30">
            <button @click="sidebarOpen = true" class="lg:hidden text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            <div class="hidden lg:block">
                <span class="text-sm text-gray-500">@yield('page', '')</span>
            </div>

            <div class="flex items-center gap-3">
                @auth
                {{-- Notifikasi Bell --}}
                <div x-data="{ notifOpen: false, count: 0, items: [], prevCount: null }"
                     x-init="
                         function playNotify() {
                             try {
                                 let ctx = new (window.AudioContext || window.webkitAudioContext)();
                                 let osc = ctx.createOscillator();
                                 let gain = ctx.createGain();
                                 osc.connect(gain);
                                 gain.connect(ctx.destination);
                                 osc.type = 'sine';
                                 osc.frequency.value = 800;
                                 gain.gain.setValueAtTime(0.3, ctx.currentTime);
                                 gain.gain.exponentialRampToValueAtTime(0.01, ctx.currentTime + 0.15);
                                 osc.start(ctx.currentTime);
                                 osc.stop(ctx.currentTime + 0.15);
                                 setTimeout(() => {
                                     let osc2 = ctx.createOscillator();
                                     let gain2 = ctx.createGain();
                                     osc2.connect(gain2);
                                     gain2.connect(ctx.destination);
                                     osc2.type = 'sine';
                                     osc2.frequency.value = 1200;
                                     gain2.gain.setValueAtTime(0.25, ctx.currentTime);
                                     gain2.gain.exponentialRampToValueAtTime(0.01, ctx.currentTime + 0.12);
                                     osc2.start(ctx.currentTime);
                                     osc2.stop(ctx.currentTime + 0.12);
                                 }, 120);
                             } catch(e) {}
                         }
                         let stored = sessionStorage.getItem('notifPrevCount');
                         prevCount = stored !== null ? parseInt(stored, 10) : null;
                         async function fetchNotif() {
                             try {
                                 let r = await (await fetch('{{ route('notifications.unread') }}')).json();
                                 if (prevCount !== null && r.count > prevCount) { playNotify(); }
                                 prevCount = r.count;
                                 sessionStorage.setItem('notifPrevCount', r.count);
                                 count = r.count;
                                 items = r.items;
                             } catch(e) {}
                         }
                         setInterval(fetchNotif, 5000);
                         fetchNotif();
                     "
                     class="relative">
                    <button @click="notifOpen = !notifOpen" class="relative p-2 text-gray-500 hover:text-indigo-600 transition rounded-lg hover:bg-gray-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <span x-show="count > 0" x-cloak
                              class="absolute -top-0.5 -right-0.5 inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-500 rounded-full">
                            <span x-text="count > 9 ? '9+' : count"></span>
                        </span>
                    </button>

                    <div x-show="notifOpen" x-cloak @click.outside="notifOpen = false"
                         class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                        <div class="px-4 py-2 border-b border-gray-100">
                            <p class="text-sm font-semibold text-gray-800">Notifikasi</p>
                        </div>
                        <template x-if="items.length === 0">
                            <div class="px-4 py-6 text-center text-sm text-gray-400">Tidak ada notifikasi</div>
                        </template>
                        <template x-for="item in items" :key="item.text">
                            <a :href="item.url" @click="notifOpen = false"
                               class="flex items-start gap-3 px-4 py-3 hover:bg-gray-50 transition border-b border-gray-50 last:border-0">
                                <span x-text="item.icon" class="text-base"></span>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm text-gray-700" x-text="item.text"></p>
                                    <p class="text-xs text-gray-400 mt-0.5" x-text="item.time"></p>
                                </div>
                            </a>
                        </template>
                    </div>
                </div>

                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center gap-2 text-sm font-medium text-gray-700 hover:text-gray-900 transition">
                        <span class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-sm font-semibold">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </span>
                        <span class="hidden sm:block">{{ auth()->user()->name }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>

                    <div x-show="open" x-cloak @click.outside="open = false"
                         class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-1 z-50">
                        <a href="{{ route('profile.edit') }}"
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                            Profil
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition">Masuk</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">Daftar</a>
                @endauth
            </div>
        </header>

        {{-- Content --}}
        <main class="flex-1 p-4 lg:p-6">
            @if(session('success'))
                <div class="mb-4 p-4 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 p-4 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm">
                    {{ session('error') }}
                </div>
            @endif
            @yield('content')
        </main>
    </div>

</div>

@vite('resources/js/app.js')
</body>
</html>
