<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="mb-6">
                <form action="{{ route('books.index') }}" method="GET" class="flex gap-2">
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari judul, penulis, atau kode..." class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 w-full md:w-1/2">
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Cari</button>
                    @if(request('search'))
                        <a href="{{ route('books.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 flex items-center">Reset</a>
                    @endif
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                @foreach($books as $book)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg h-full flex flex-col">
                        <div class="relative h-48 bg-gray-200 overflow-hidden">
                            @if($book->cover_image)
                                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->judul }}" class="w-full h-full object-cover">
                            @else
                                <div class="flex items-center justify-center h-full text-gray-400">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute top-0 right-0 m-2">
                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded opacity-90">{{ $book->kategori }}</span>
                            </div>
                        </div>
                        <div class="p-6 flex-grow">
                            <div class="mb-2">
                                <h3 class="text-xl font-bold text-gray-900 line-clamp-2">{{ $book->judul }}</h3>
                            </div>
                            <p class="text-gray-600 mb-4 text-sm">{{ $book->penulis }} ({{ $book->tahun_terbit }})</p>
                            <div class="flex items-center justify-between mt-auto">
                                <span class="text-xs text-gray-500">Penerbit: {{ $book->penerbit }}</span>
                                <span class="text-sm font-semibold {{ $book->stok > 0 ? 'text-green-600' : 'text-red-600' }}">
                                    Stok: {{ $book->stok }}
                                </span>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-6 py-4 border-t border-gray-100">
                           <form action="{{ route('borrow.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                
                                <div class="mb-3">
                                    <label for="date-{{ $book->id }}" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kembali</label>
                                    <input type="date" id="date-{{ $book->id }}" name="tanggal_jatuh_tempo" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                                </div>

                                <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 {{ $book->stok < 1 ? 'opacity-50 cursor-not-allowed' : '' }}" {{ $book->stok < 1 ? 'disabled' : '' }}>
                                    {{ $book->stok > 0 ? 'Pinjam Sekarang' : 'Stok Habis' }}
                                </button>
                           </form>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $books->withQueryString()->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
