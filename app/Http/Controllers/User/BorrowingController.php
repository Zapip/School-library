<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::where('user_id', auth()->id())
            ->with('book')
            ->latest()
            ->get();
            
        return view('user.borrowings.index', compact('borrowings'));
    }
}
