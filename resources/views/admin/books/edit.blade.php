<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.books.update', $book) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="kode_buku" :value="__('Kode Buku')" />
                                <x-text-input id="kode_buku" class="block mt-1 w-full" type="text" name="kode_buku" :value="old('kode_buku', $book->kode_buku)" required />
                                <x-input-error :messages="$errors->get('kode_buku')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="judul" :value="__('Judul Buku')" />
                                <x-text-input id="judul" class="block mt-1 w-full" type="text" name="judul" :value="old('judul', $book->judul)" required />
                                <x-input-error :messages="$errors->get('judul')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="penulis" :value="__('Penulis')" />
                                <x-text-input id="penulis" class="block mt-1 w-full" type="text" name="penulis" :value="old('penulis', $book->penulis)" required />
                                <x-input-error :messages="$errors->get('penulis')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="penerbit" :value="__('Penerbit')" />
                                <x-text-input id="penerbit" class="block mt-1 w-full" type="text" name="penerbit" :value="old('penerbit', $book->penerbit)" required />
                                <x-input-error :messages="$errors->get('penerbit')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="tahun_terbit" :value="__('Tahun Terbit')" />
                                <x-text-input id="tahun_terbit" class="block mt-1 w-full" type="number" name="tahun_terbit" :value="old('tahun_terbit', $book->tahun_terbit)" required />
                                <x-input-error :messages="$errors->get('tahun_terbit')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="kategori" :value="__('Kategori')" />
                                <x-text-input id="kategori" class="block mt-1 w-full" type="text" name="kategori" :value="old('kategori', $book->kategori)" required />
                                <x-input-error :messages="$errors->get('kategori')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="stok" :value="__('Stok')" />
                                <x-text-input id="stok" class="block mt-1 w-full" type="number" name="stok" :value="old('stok', $book->stok)" required min="0" />
                                <x-input-error :messages="$errors->get('stok')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="cover_image" :value="__('Cover Buku (Optional)')" />
                                @if($book->cover_image)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover" class="w-20 h-32 object-cover rounded">
                                    </div>
                                @endif
                                <input id="cover_image" class="block mt-1 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" type="file" name="cover_image">
                                <x-input-error :messages="$errors->get('cover_image')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Update Buku') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
