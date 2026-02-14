<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Peminjam
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Buku
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Tanggal Pinjam
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Jatuh Tempo
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($borrowings as $borrowing)
                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <div class="font-bold">{{ $borrowing->user->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $borrowing->user->email }}</div>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <div class="font-bold">{{ $borrowing->book->judul }}</div>
                                        <div class="text-xs text-gray-500">{{ $borrowing->book->kode_buku }}</div>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        {{ $borrowing->tanggal_pinjam->format('d M Y') }}
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        {{ $borrowing->tanggal_jatuh_tempo->format('d M Y') }}
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <span class="relative inline-block px-3 py-1 font-semibold leading-tight {{ $borrowing->status === 'dikembalikan' ? 'text-green-900' : 'text-yellow-900' }}">
                                            <span aria-hidden="true" class="absolute inset-0 {{ $borrowing->status === 'dikembalikan' ? 'bg-green-200' : 'bg-yellow-200' }} opacity-50 rounded-full"></span>
                                            <span class="relative">{{ ucfirst($borrowing->status) }}</span>
                                        </span>
                                        @if($borrowing->denda > 0)
                                            <div class="mt-1 text-xs text-red-600 font-bold">
                                                Denda: Rp {{ number_format($borrowing->denda, 0, ',', '.') }}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        @if($borrowing->status === 'dipinjam')
                                            <form action="{{ route('admin.borrowings.return', $borrowing) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-xs" onclick="return confirm('Proses pengembalian buku ini?')">
                                                    Proses Kembali
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-xs text-gray-500">
                                                Kembali: {{ $borrowing->tanggal_kembali?->format('d M Y') }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
