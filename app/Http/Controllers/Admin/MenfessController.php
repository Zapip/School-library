<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menfess;
use Illuminate\Http\Request;

class MenfessController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->input('status', 'pending');
        
        $menfesses = Menfess::with(['user', 'book', 'reports'])
            ->when($status, function ($query) use ($status) {
                if ($status !== 'all') {
                    $query->where('status', $status);
                }
            })
            ->withCount('reports')
            ->latest()
            ->paginate(10);
            
        return view('admin.menfess.index', compact('menfesses', 'status'));
    }

    public function update(Request $request, Menfess $menfess)
    {
        $validated = $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $menfess->update(['status' => $validated['status']]);

        return redirect()->back()->with('success', 'Status menfess berhasil diperbarui.');
    }
    
    public function delete(Menfess $menfess)
    {
        $menfess->delete();
        return redirect()->back()->with('success', 'Menfess berhasil dihapus.');
    }
}
