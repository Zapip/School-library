<x-app-layout>
    <div class="space-y-8" data-animate="fade-in-up">
        
        <!-- Breadcrumb / Back -->
        <div>
            <a href="{{ route('books.index') }}" class="inline-flex items-center text-gray-500 hover:text-gray-900 transition-colors font-medium">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Daftar Buku
            </a>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-8 md:p-12 overflow-hidden relative">
            
            <div class="flex flex-col md:flex-row gap-12">
                <!-- Left Column: Cover Image -->
                <div class="w-full md:w-1/3 flex-shrink-0">
                    <div class="rounded-2xl overflow-hidden shadow-lg border border-gray-100 relative">
                        @if($book->cover_image)
                            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->judul }}" class="w-full h-auto object-cover">
                        @else
                            <div class="w-full aspect-[2/3] bg-gray-50 flex items-center justify-center text-gray-300">
                                <svg class="w-32 h-32" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Metadata Grid -->
                    <div class="mt-8 grid grid-cols-2 gap-4">
                        <div class="p-4 bg-gray-50 rounded-2xl text-center border border-gray-100">
                             <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Stok Buku</p>
                             <p class="text-xl font-bold {{ $book->stok > 0 ? 'text-green-600' : 'text-red-500' }}">
                                 {{ $book->stok }}
                             </p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-2xl text-center border border-gray-100">
                             <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Tahun</p>
                             <p class="text-xl font-bold text-gray-900">{{ $book->tahun_terbit }}</p>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Details -->
                <div class="flex-1 flex flex-col">
                    <div class="mb-8 border-b border-gray-100 pb-8">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="bg-green-100 text-green-800 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">{{ $book->kategori }}</span>
                            <span class="text-gray-400 text-sm font-mono bg-gray-50 px-2 py-1 rounded">{{ $book->kode_buku }}</span>
                        </div>
                        
                        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4 leading-tight tracking-tight">{{ $book->judul }}</h1>
                        <p class="text-xl text-gray-500">ditulis oleh <span class="text-gray-900 font-semibold">{{ $book->penulis }}</span></p>
                         <p class="text-base text-gray-400 mt-1">Diterbitkan oleh {{ $book->penerbit }}</p>
                    </div>

                    <div class="mb-10 flex-grow">
                         <h3 class="text-lg font-bold text-gray-900 mb-4">Tentang Buku Ini</h3>
                         <div class="prose prose-lg text-gray-600 leading-relaxed max-w-none">
                             <p>
                                 {{-- Placeholder Description until available in DB --}}
                                 Buku ini merupakan salah satu koleksi terpopuler di perpustakaan SMKN 2 Magelang. Ditulis oleh <strong>{{ $book->penulis }}</strong> dan diterbitkan oleh <strong>{{ $book->penerbit }}</strong> pada tahun {{ $book->tahun_terbit }}, buku ini mencakup wawasan mendalam yang relevan untuk kategori {{ $book->kategori }}.
                             </p>
                             <p class="mt-4">
                                 Sangat direkomendasikan untuk siswa yang ingin memperdalam pengetahuan di bidang ini. Segera pinjam sebelum kehabisan stok!
                             </p>
                         </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-auto">
                        <form action="{{ route('borrow.store') }}" method="POST" class="bg-gray-50 p-6 rounded-2xl border border-gray-100">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            <div class="flex flex-col md:flex-row items-center gap-4">
                                <div class="flex-grow w-full">
                                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 ml-1">Pilih Tanggal Kembali</label>
                                    <input type="date" name="tanggal_jatuh_tempo" class="w-full rounded-xl border-gray-200 bg-white p-3 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition shadow-sm" required min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                                </div>
                                <div class="w-full md:w-auto pt-6">
                                     <button type="submit" class="w-full md:w-auto bg-gray-900 text-white rounded-xl px-8 py-3.5 font-bold shadow-lg hover:bg-black transition-all transform hover:-translate-y-1 hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none" {{ $book->stok < 1 ? 'disabled' : '' }}>
                                        {{ $book->stok > 0 ? 'Pinjam Sekarang' : 'Stok Habis' }}
                                    </button>
                                </div>
                            </div>
                             @if($book->stok < 1)
                                <p class="text-red-500 text-xs mt-3 font-bold text-center md:text-left">* Maaf, buku ini sedang dipinjam semua.</p>
                            @endif
                        </form>
                    </div>

                </div>
            </div>
            
             <!-- Decorative Abstract Blob -->
            <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-gradient-to-br from-green-50 to-blue-50 rounded-full blur-3xl opacity-50 -z-10 pointer-events-none"></div>
        </div>
    </div>
</x-app-layout>
