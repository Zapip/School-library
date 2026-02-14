<x-app-layout>
    <div class="space-y-8" data-animate="fade-in-up">
        
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Pengajuan Buku</h2>
                <p class="text-gray-500 mt-1">Status request buku yang Anda ajukan.</p>
            </div>
            <a href="{{ route('requests.create') }}" class="bg-gray-900 text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:bg-black transition-transform hover:-translate-y-1 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                <span>Ajukan Baru</span>
            </a>
        </div>

        @if(session('success'))
            <div class="rounded-xl bg-green-50 border border-green-100 text-green-700 px-6 py-4 relative shadow-sm flex items-center gap-3" role="alert">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="block sm:inline font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            @if($requests->isEmpty())
                <div class="text-center py-16">
                    <div class="bg-gray-50 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4 text-gray-400">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Belum ada pengajuan</h3>
                    <p class="text-gray-500 mt-1">Mulai ajukan buku yang ingin Anda baca.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr class="border-b border-gray-100">
                                <th class="px-6 py-4 bg-gray-50 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    Judul Buku
                                </th>
                                <th class="px-6 py-4 bg-gray-50 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    Penulis
                                </th>
                                <th class="px-6 py-4 bg-gray-50 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    Tanggal
                                </th>
                                <th class="px-6 py-4 bg-gray-50 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 bg-white">
                            @foreach($requests as $request)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-5">
                                    <div class="font-bold text-gray-900 text-base">{{ $request->judul }}</div>
                                    <div class="text-xs text-gray-400 mt-1 uppercase tracking-wide">{{ $request->penerbit ?? 'Penerbit -' }}</div>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="text-gray-600 font-medium">{{ $request->penulis }}</span>
                                </td>
                                <td class="px-6 py-5 text-gray-500 font-medium text-sm">
                                    {{ $request->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-5">
                                    @php
                                        $statusClasses = match($request->status) {
                                            'approved' => 'bg-green-50 text-green-700 border-green-100',
                                            'rejected' => 'bg-red-50 text-red-700 border-red-100',
                                            default => 'bg-yellow-50 text-yellow-700 border-yellow-100',
                                        };
                                        $statusIcon = match($request->status) {
                                            'approved' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>',
                                            'rejected' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>',
                                            default => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                                        };
                                    @endphp
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold border {{ $statusClasses }}">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $statusIcon !!}</svg>
                                        {{ ucfirst($request->status) }}
                                    </span>
                                    @if($request->status === 'rejected' && $request->admin_note)
                                        <p class="text-xs text-red-500 mt-2 max-w-xs bg-red-50 p-2 rounded-lg border border-red-100">
                                            Note: {{Str::limit($request->admin_note, 50)}}
                                        </p>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-50">
                    {{ $requests->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
