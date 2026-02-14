<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Menfess Space') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Submit Form -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Kirim Menfess</h3>
                    <form action="{{ route('menfess.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="sender" class="block text-sm font-medium text-gray-700">Dari (Nama Samaran / Opsional)</label>
                                <input type="text" id="sender" name="sender" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Anonymous">
                            </div>
                            <div>
                                <label for="receiver" class="block text-sm font-medium text-gray-700">Untuk (Mention) <span class="text-red-500">*</span></label>
                                <input type="text" id="receiver" name="receiver" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Siapa yang mau di-mention?">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="message" class="block text-sm font-medium text-gray-700">Pesan</label>
                            <textarea id="message" name="message" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required placeholder="Tulis pesanmu di sini..."></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="book_id" class="block text-sm font-medium text-gray-700">Rujukan Buku (Opsional)</label>
                            <select id="book_id" name="book_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">-- Pilih Buku --</option>
                                @foreach($books as $book)
                                    <option value="{{ $book->id }}">{{ $book->judul }} - {{ $book->penulis }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Kirim</button>
                    </form>
                </div>
            </div>

            <!-- Feed -->
            <div class="space-y-6">
                @foreach($menfesses as $menfess)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-bold text-lg text-indigo-700">
                                        {{ $menfess->sender }} <span class="text-gray-400 text-sm font-normal">to</span> {{ $menfess->receiver }}
                                    </h4>
                                    <span class="text-gray-500 text-xs">{{ $menfess->created_at->diffForHumans() }}</span>
                                </div>
                                <!-- Report Form -->
                                <div x-data="{ open: false }">
                                    <button @click="open = !open" class="text-gray-400 hover:text-red-500 text-sm">
                                        Report
                                    </button>
                                    <div x-show="open" class="absolute bg-white border shadow-lg p-4 rounded mt-2 right-10 z-10 w-64">
                                        <form action="{{ route('menfess.report', $menfess) }}" method="POST">
                                            @csrf
                                            <input type="text" name="reason" placeholder="Alasan lapor..." class="w-full text-sm border-gray-300 rounded mb-2" required>
                                            <div class="flex justify-end gap-2">
                                                <button type="button" @click="open = false" class="text-xs text-gray-500">Batal</button>
                                                <button type="submit" class="text-xs bg-red-500 text-white px-2 py-1 rounded">Kirim</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <p class="mt-4 text-gray-800 text-lg">{{ $menfess->message }}</p>

                            @if($menfess->book)
                                <div class="mt-4 bg-gray-50 p-4 rounded-lg flex items-center border border-gray-200">
                                    @if($menfess->book->cover_image)
                                        <img src="{{ asset('storage/' . $menfess->book->cover_image) }}" alt="Cover" class="w-12 h-16 object-cover rounded mr-4">
                                    @else
                                        <div class="w-12 h-16 bg-gray-200 rounded mr-4 flex items-center justify-center text-gray-400">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                        </div>
                                    @endif
                                    <div>
                                        <h4 class="font-semibold text-gray-900">{{ $menfess->book->judul }}</h4>
                                        <p class="text-sm text-gray-600">{{ $menfess->book->penulis }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-6">
                {{ $menfesses->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
