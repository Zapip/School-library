<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookRequest;
use Illuminate\Http\Request;

class BookRequestController extends Controller
{
    public function index()
    {
        $requests = BookRequest::with('user')->latest()->paginate(10);
        return view('admin.requests.index', compact('requests'));
    }

    public function update(Request $request, BookRequest $bookRequest)
    {
        $validated = $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $bookRequest->update(['status' => $validated['status']]);

        return redirect()->back()->with('success', 'Status pengajuan berhasil diperbarui.');
    }
}
