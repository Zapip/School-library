<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Moderasi Menfess') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Filter Tabs -->
            <div class="mb-6 border-b border-gray-200">
                <nav class="-mb-px flex space-x-8">
                    @foreach(['pending', 'approved', 'rejected', 'all'] as $filter)
                        <a href="{{ route('admin.menfess.index', ['status' => $filter]) }}"
                           class="{{ request('status', 'pending') == $filter ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm capitalize">
                           {{ $filter }}
                        </a>
                    @endforeach
                </nav>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($menfesses->isEmpty())
                        <div class="text-center py-8 text-gray-500">
                            Tidak ada data menfess.
                        </div>
                    @else
                        <div class="space-y-6">
                            @foreach($menfesses as $menfess)
                                <div class="border rounded-lg p-4 {{ $menfess->reports_count > 0 ? 'border-red-300 bg-red-50' : 'border-gray-200' }}">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <div class="flex items-center gap-2 mb-2">
                                                <span class="font-bold text-gray-700">User #{{ $menfess->user_id }}</span>
                                                <span class="text-gray-500 text-xs">{{ $menfess->created_at->format('d M Y H:i') }}</span>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $menfess->status === 'approved' ? 'bg-green-100 text-green-800' : ($menfess->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                                    {{ ucfirst($menfess->status) }}
                                                </span>
                                            </div>
                                            
                                            <div class="text-sm text-gray-800 mb-2">
                                                <strong>From:</strong> {{ $menfess->sender }} <br>
                                                <strong>To:</strong> {{ $menfess->receiver }}
                                            </div>

                                            @if($menfess->reports_count > 0)
                                                <div class="text-red-600 text-sm font-bold mt-1">
                                                    ⚠️ Dilaporkan {{ $menfess->reports_count }} kali
                                                    <details class="font-normal text-xs text-gray-600 mt-1 cursor-pointer">
                                                        <summary>Lihat alasan</summary>
                                                        <ul class="list-disc pl-4 mt-1">
                                                            @foreach($menfess->reports as $report)
                                                                <li>{{ $report->reason }} (User #{{ $report->user_id }})</li>
                                                            @endforeach
                                                        </ul>
                                                    </details>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex gap-2">
                                            @if($menfess->status === 'pending')
                                                <form action="{{ route('admin.menfess.update', $menfess) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="approved">
                                                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded text-xs">
                                                        Approve
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.menfess.update', $menfess) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-xs">
                                                        Reject
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('admin.menfess.destroy', $menfess) }}" method="POST" onsubmit="return confirm('Hapus permanen?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm">Hapus</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>

                                    <p class="mt-2 text-gray-800">{{ $menfess->message }}</p>

                                    @if($menfess->book)
                                        <div class="mt-2 text-sm text-gray-600 bg-gray-100 p-2 rounded">
                                            📚 Rujukan: <span class="font-semibold">{{ $menfess->book->judul }}</span>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4">
                            {{ $menfesses->appends(['status' => request('status')])->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
