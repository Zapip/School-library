<x-app-layout>
    <div class="space-y-8">
        <!-- Hero Section -->
        <div class="relative overflow-hidden rounded-[2.5rem] bg-white text-gray-900 shadow-2xl ring-1 ring-gray-900/5">
            <div class="absolute inset-0">
                <img src="https://images.unsplash.com/photo-1521587760476-6c12a4b040da?ixlib=rb-1.2.1&auto=format&fit=crop&w=1600&q=80" 
                     alt="Library Background" 
                     class="h-full w-full object-cover object-center opacity-90">
                <div class="absolute inset-0 bg-gradient-to-r from-gray-900/80 via-gray-900/60 to-transparent"></div>
            </div>
            
            <div class="relative px-8 py-16 sm:px-16 sm:py-24 lg:py-28 lg:px-20">
                <span class="inline-flex items-center gap-2 rounded-full bg-green-500/20 px-4 py-1.5 text-sm font-medium text-green-100 ring-1 ring-inset ring-green-500/30 backdrop-blur-sm mb-6">
                    <span class="h-2 w-2 rounded-full bg-green-400 animate-pulse"></span>
                    Perpustakaan Digital
                </span>
                
                <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl max-w-2xl mb-6 drop-shadow-sm font-['DM_Sans']">
                    Temukan Jendela <br>
                    <span class="text-green-400">Dunia Pengetahuan</span>
                </h1>
                
                <p class="mt-6 text-lg leading-8 text-gray-300 max-w-xl mb-10">
                    Akses ribuan buku fisik dan digital. Pinjam buku dengan mudah, ajukan judul baru, dan kirim pesan anonim melalui Menfess.
                </p>

                <!-- Search Bar -->
                <div class="bg-white/95 backdrop-blur-xl p-3 rounded-[2rem] shadow-2xl max-w-3xl flex flex-col sm:flex-row items-center gap-2 border border-white/20">
                    <div class="flex-1 w-full px-4 py-2">
                        <label for="search" class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1 ml-1">Cari Buku</label>
                        <input type="text" id="search" placeholder="Judul, Penulis, atau ISBN..." class="w-full border-none p-0 text-gray-900 placeholder-gray-400 focus:ring-0 text-lg font-medium bg-transparent">
                    </div>
                    
                    <div class="hidden sm:block w-px h-12 bg-gray-200"></div>
                    
                    <div class="w-full sm:w-auto px-4 py-2">
                        <label for="category" class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1 ml-1">Kategori</label>
                        <select id="category" class="w-full border-none p-0 text-gray-900 focus:ring-0 text-lg font-medium bg-transparent cursor-pointer pr-8">
                            <option>Semua</option>
                            <option>Fiksi</option>
                            <option>Pelajaran</option>
                            <option>Novel</option>
                            <option>Komik</option>
                        </select>
                    </div>

                    <button class="w-full sm:w-auto bg-green-600 hover:bg-green-700 text-white rounded-[1.5rem] px-8 py-4 font-bold shadow-lg transition-transform hover:scale-105 active:scale-95 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <span>Cari</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Stats / Quick Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @if(auth()->user()->isAdmin())
                <!-- Admin Card 1 -->
                <div class="group relative overflow-hidden rounded-[2rem] bg-white p-8 shadow-xl transition-all hover:shadow-2xl hover:-translate-y-1">
                    <div class="absolute right-0 top-0 -mr-8 -mt-8 h-32 w-32 rounded-full bg-blue-50 opacity-50 transition-all group-hover:scale-150"></div>
                    <div class="relative">
                        <div class="mb-4 inline-flex h-14 w-14 items-center justify-center rounded-[1.2rem] bg-blue-100 text-blue-600 shadow-sm">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        <h3 class="text-4xl font-bold text-gray-900 tracking-tight">{{ $totalBooks }}</h3>
                        <p class="mt-1 text-sm font-medium text-gray-500 uppercase tracking-wide">Total Koleksi Buku</p>
                        <div class="mt-4 h-1 w-12 rounded-full bg-blue-500"></div>
                    </div>
                </div>

                <!-- Admin Card 2 -->
                <div class="group relative overflow-hidden rounded-[2rem] bg-white p-8 shadow-xl transition-all hover:shadow-2xl hover:-translate-y-1">
                    <div class="absolute right-0 top-0 -mr-8 -mt-8 h-32 w-32 rounded-full bg-green-50 opacity-50 transition-all group-hover:scale-150"></div>
                    <div class="relative">
                        <div class="mb-4 inline-flex h-14 w-14 items-center justify-center rounded-[1.2rem] bg-green-100 text-green-600 shadow-sm">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </div>
                        <h3 class="text-4xl font-bold text-gray-900 tracking-tight">{{ $totalUsers }}</h3>
                        <p class="mt-1 text-sm font-medium text-gray-500 uppercase tracking-wide">Anggota Terdaftar</p>
                        <div class="mt-4 h-1 w-12 rounded-full bg-green-500"></div>
                    </div>
                </div>

                <!-- Admin Card 3 -->
                <div class="group relative overflow-hidden rounded-[2rem] bg-white p-8 shadow-xl transition-all hover:shadow-2xl hover:-translate-y-1">
                    <div class="absolute right-0 top-0 -mr-8 -mt-8 h-32 w-32 rounded-full bg-orange-50 opacity-50 transition-all group-hover:scale-150"></div>
                    <div class="relative">
                        <div class="mb-4 inline-flex h-14 w-14 items-center justify-center rounded-[1.2rem] bg-orange-100 text-orange-600 shadow-sm">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-4xl font-bold text-gray-900 tracking-tight">{{ $activeBorrowings }}</h3>
                        <p class="mt-1 text-sm font-medium text-gray-500 uppercase tracking-wide">Peminjaman Aktif</p>
                        <div class="mt-4 h-1 w-12 rounded-full bg-orange-500"></div>
                    </div>
                </div>
            @else
                <!-- User Card 1 -->
                <div class="group relative overflow-hidden rounded-[2rem] bg-white p-8 shadow-xl transition-all hover:shadow-2xl hover:-translate-y-1">
                    <div class="absolute right-0 top-0 -mr-8 -mt-8 h-32 w-32 rounded-full bg-blue-50 opacity-50 transition-all group-hover:scale-150"></div>
                    <div class="relative">
                        <div class="mb-4 inline-flex h-14 w-14 items-center justify-center rounded-[1.2rem] bg-blue-100 text-blue-600 shadow-sm">
                             <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-4xl font-bold text-gray-900 tracking-tight">{{ $myActiveBorrowings }}</h3>
                        <p class="mt-1 text-sm font-medium text-gray-500 uppercase tracking-wide">Peminjaman Saya</p>
                        <div class="mt-4 h-1 w-12 rounded-full bg-blue-500"></div>
                        <a href="{{ route('borrowings.index') }}" class="absolute inset-0"></a>
                    </div>
                </div>

                <!-- User Card 2 (Promo) -->
                <div class="group relative overflow-hidden rounded-[2rem] bg-gray-900 p-8 shadow-xl transition-all hover:shadow-2xl hover:-translate-y-1 col-span-1 md:col-span-2">
                    <div class="absolute inset-0">
                         <img src="https://images.unsplash.com/photo-1481627834876-b7833e8f5570?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" 
                              class="h-full w-full object-cover opacity-40 transition-opacity group-hover:opacity-30">
                    </div>
                    <div class="relative h-full flex flex-col justify-between">
                        <div>
                            <span class="inline-block rounded-full bg-white/20 px-3 py-1 text-xs font-bold text-white backdrop-blur-md mb-4">Recommended</span>
                            <h3 class="text-3xl font-bold text-white tracking-tight leading-tight">Jelajahi Koleksi <br>Terbaru Minggu Ini</h3>
                        </div>
                        <div class="mt-6">
                            <a href="{{ route('books.index') }}" class="inline-flex items-center gap-2 rounded-full bg-white px-6 py-3 font-bold text-gray-900 transition hover:bg-gray-100">
                                <span>Lihat Katalog</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Section Title Example -->
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-800 tracking-tight">Kategori Populer</h2>
            <a href="#" class="text-sm font-bold text-green-600 hover:text-green-700">Lihat Semua -></a>
        </div>
        
        <!-- Category Pills (Visual Only) -->
        <div class="flex gap-4 overflow-x-auto pb-4 scrollbar-hide">
            @foreach(['Teknologi', 'Seni Budaya', 'Sejarah', 'Sains', 'Bahasa', 'Novel'] as $cat)
                <button class="flex-shrink-0 px-6 py-3 rounded-2xl bg-white shadow-md hover:shadow-lg hover:bg-green-50 text-gray-700 font-bold transition">
                    {{ $cat }}
                </button>
            @endforeach
        </div>

    </div>
</x-app-layout>
