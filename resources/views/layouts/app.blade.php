<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;500;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            .glass-panel {
                background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.3);
            }
            .glass-sidebar {
                background: rgba(255, 255, 255, 0.85);
                backdrop-filter: blur(16px);
                border-right: 1px solid rgba(255, 255, 255, 0.4);
            }
        </style>
    </head>
    <body class="font-['DM_Sans'] antialiased text-gray-800 bg-cover bg-center bg-fixed" style="background-image: url('https://images.unsplash.com/photo-1541963463532-d68292c34b19?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
        
        <div class="flex h-screen overflow-hidden">
            
            <!-- Sidebar -->
            <aside class="w-72 flex-shrink-0 hidden md:flex flex-col glass-sidebar shadow-2xl z-30 transition-all duration-300">
                <div class="p-8 flex items-center justify-center flex-col border-b border-gray-100/50">
                    <div class="p-2 bg-white rounded-2xl shadow-sm mb-4">
                        <img src="{{ asset('logo.png') }}" alt="Logo" class="h-12 w-auto">
                    </div>
                    <h1 class="text-base font-bold text-gray-900 text-center tracking-tight leading-tight">PERPUSTAKAAN<br><span class="text-green-700">SMKN 2 MAGELANG</span></h1>
                </div>

                <nav class="flex-1 overflow-y-auto py-6 space-y-1 px-4">
                    <p class="px-4 text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Menu Utama</p>
                    <x-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" icon="home">
                        Dashboard
                    </x-sidebar-link>

                    @if(auth()->user()->isAdmin())
                        <p class="px-4 text-xs font-bold text-gray-400 uppercase tracking-wider mt-6 mb-2">Administrator</p>
                        <x-sidebar-link :href="route('admin.books.index')" :active="request()->routeIs('admin.books.*')" icon="book-open">
                            Kelola Buku
                        </x-sidebar-link>
                        <x-sidebar-link :href="route('admin.borrowings.index')" :active="request()->routeIs('admin.borrowings.*')" icon="switch-horizontal">
                            Transaksi
                        </x-sidebar-link>
                        <x-sidebar-link :href="route('admin.requests.index')" :active="request()->routeIs('admin.requests.*')" icon="plus-circle">
                            Pengajuan Buku
                        </x-sidebar-link>
                        <x-sidebar-link :href="route('admin.menfess.index')" :active="request()->routeIs('admin.menfess.*')" icon="chat-alt-2">
                            Moderasi Menfess
                        </x-sidebar-link>
                    @else
                        <p class="px-4 text-xs font-bold text-gray-400 uppercase tracking-wider mt-6 mb-2">Member Area</p>
                        <x-sidebar-link :href="route('books.index')" :active="request()->routeIs('books.*')" icon="book-open">
                            Daftar Buku
                        </x-sidebar-link>
                        <x-sidebar-link :href="route('borrowings.index')" :active="request()->routeIs('borrowings.index')" icon="collection">
                            Peminjaman Saya
                        </x-sidebar-link>
                        <x-sidebar-link :href="route('requests.index')" :active="request()->routeIs('requests.*')" icon="plus-circle">
                            Request Buku
                        </x-sidebar-link>
                        <x-sidebar-link :href="route('menfess.index')" :active="request()->routeIs('menfess.*')" icon="chat-alt-2">
                            Menfess Space
                        </x-sidebar-link>
                    @endif
                </nav>

                <div class="p-6 border-t border-gray-100/50 bg-white/40">
                    <div class="flex items-center gap-3">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=10B981&color=fff" alt="Avatar" class="w-10 h-10 rounded-full shadow-sm">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-gray-900 truncate">
                                {{ Auth::user()->name }}
                            </p>
                            <p class="text-xs text-gray-500 truncate">
                                {{ Auth::user()->role === 'admin' ? 'Administrator' : 'Access Granted' }}
                            </p>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col h-screen overflow-hidden relative">
                <!-- Mobile Header -->
                <header class="md:hidden glass-panel border-b border-white/30 p-4 flex justify-between items-center z-20 mx-4 mt-4 rounded-2xl shadow-lg">
                    <div class="flex items-center gap-2">
                        <img src="{{ asset('logo.png') }}" alt="Logo" class="h-8 w-auto">
                        <span class="font-bold text-gray-800 text-sm">SMKN 2 MGL</span>
                    </div>
                    <button @click="sidebarOpen = !sidebarOpen" class="text-gray-700 bg-white/50 p-2 rounded-lg hover:bg-white/80 transition shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <!-- Mobile Menu Dropdown could go here, simplified for now -->
                </header>

                <!-- Page Content -->
                <main class="flex-1 overflow-x-hidden overflow-y-auto w-full p-4 md:p-8 scroll-smooth">
                    @if (isset($header))
                        {{-- Header removed to fit the "Hero" style more naturally, 
                             or we can keep it as a breadcrumb/title --}}
                    @endif

                    {{ $slot }}
                </main>
            </div>

        </div>
    </body>
</html>
