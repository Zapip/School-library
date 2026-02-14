<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BookRequest;
use Illuminate\Http\Request;

class BookRequestController extends Controller
{
    public function index()
    {
        $requests = auth()->user()->bookRequests()->latest()->paginate(10);
        return view('user.requests.index', compact('requests'));
    }

    public function create()
    {
        return view('user.requests.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'nullable|string|max:255',
            'kategori' => 'nullable|string|max:255',
            'alasan' => 'nullable|string',
        ]);

        auth()->user()->bookRequests()->create($validated);

        return redirect()->route('requests.index')->with('success', 'Pengajuan buku berhasil dikirim.');
    }
}
