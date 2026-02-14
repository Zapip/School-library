<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function index()
    {
        // Ensure admin access if not handled by middleware
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $borrowings = Borrowing::with(['user', 'book'])->latest()->get();
        return view('admin.borrowings.index', compact('borrowings'));
    }
}
