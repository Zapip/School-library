<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajukan Buku Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('requests.store') }}" method="POST">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="judul" :value="__('Judul Buku')" />
                                <x-text-input id="judul" class="block mt-1 w-full" type="text" name="judul" :value="old('judul')" required autofocus />
                                <x-input-error :messages="$errors->get('judul')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="penulis" :value="__('Penulis')" />
                                <x-text-input id="penulis" class="block mt-1 w-full" type="text" name="penulis" :value="old('penulis')" required />
                                <x-input-error :messages="$errors->get('penulis')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="penerbit" :value="__('Penerbit (Opsional)')" />
                                <x-text-input id="penerbit" class="block mt-1 w-full" type="text" name="penerbit" :value="old('penerbit')" />
                                <x-input-error :messages="$errors->get('penerbit')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="kategori" :value="__('Kategori (Opsional)')" />
                                <x-text-input id="kategori" class="block mt-1 w-full" type="text" name="kategori" :value="old('kategori')" />
                                <x-input-error :messages="$errors->get('kategori')" class="mt-2" />
                            </div>

                            <div class="md:col-span-2">
                                <x-input-label for="alasan" :value="__('Alasan Pengajuan (Opsional)')" />
                                <textarea id="alasan" name="alasan" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" rows="3">{{ old('alasan') }}</textarea>
                                <x-input-error :messages="$errors->get('alasan')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Kirim Pengajuan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
