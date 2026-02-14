<x-app-layout>
    <div class="space-y-8">
        <!-- Header & Search -->
        <div class="flex flex-col md:flex-row justify-between items-end gap-4" data-animate="fade-in-up">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Daftar Buku</h2>
                <p class="text-gray-500 mt-1">Temukan buku menarik untuk dibaca hari ini.</p>
            </div>
            
            <div class="w-full md:w-auto">
                <form action="{{ route('books.index') }}" method="GET" class="relative group">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-green-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                    <input type="text" name="search" value="{{ $search ?? '' }}" class="pl-10 pr-4 py-2.5 w-full md:w-64 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-all shadow-sm" placeholder="Cari judul...">
                </form>
            </div>
        </div>

        <!-- Books Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6" data-animate="stagger-children">
            @forelse($books as $book)
                <div class="group bg-white rounded-2xl p-3 shadow-sm hover:shadow-md border border-gray-100 transition-all duration-300 hover:-translate-y-1 relative">
                    <!-- Link Overlay -->
                    <a href="{{ route('books.show', $book) }}" class="absolute inset-0 z-10"></a>

                    <!-- Cover -->
                    <div class="aspect-[2/3] bg-gray-100 rounded-xl overflow-hidden mb-3 relative">
                        @if($book->cover_image)
                            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->judul }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-300">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            </div>
                        @endif
                        
                        <!-- Badges -->
                        <div class="absolute top-2 right-2 flex flex-col items-end gap-1">
                             <span class="bg-white/95 backdrop-blur shadow-sm text-gray-800 text-[10px] font-bold px-2 py-1 rounded-md uppercase tracking-wide">
                                {{ $book->kategori }}
                            </span>
                            @if($book->stok < 1)
                                <span class="bg-red-500 text-white text-[10px] font-bold px-2 py-1 rounded-md uppercase tracking-wide shadow-sm">Habis</span>
                            @endif
                        </div>
                    </div>

                    <!-- Details -->
                    <div class="px-1">
                        <h3 class="font-bold text-gray-900 leading-tight line-clamp-2 mb-1 group-hover:text-green-700 transition-colors">
                            {{ $book->judul }}
                        </h3>
                        <p class="text-xs text-gray-500 mb-3">{{ $book->penulis }}</p>
                        
                        <!-- Action (Visual only, actual link is overlay) -->
                        <div class="flex items-center justify-between mt-auto pt-2 border-t border-gray-50">
                             <span class="text-xs font-medium text-gray-400">{{ $book->tahun_terbit }}</span>
                             <span class="text-xs font-bold text-green-600 flex items-center opacity-0 group-hover:opacity-100 transition-opacity -translate-x-2 group-hover:translate-x-0 duration-300">
                                 Deatil <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                             </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center">
                    <div class="bg-gray-50 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">Tidak ada buku ditemukan</h3>
                    <p class="text-gray-500">Coba cari dengan kata kunci lain.</p>
                </div>
            @endforelse
        </div>

        <div class="pt-6">
            {{ $books->links() }}
        </div>
    </div>
</x-app-layout>
