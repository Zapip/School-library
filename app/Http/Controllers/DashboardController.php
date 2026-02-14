<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->isAdmin()) {
            $totalBooks = Book::count();
            $totalUsers = User::where('role', 'user')->count();
            $activeBorrowings = Borrowing::where('status', 'dipinjam')->count();
            // $monthlyStats = ... (optional chart data)

            return view('dashboard', compact('totalBooks', 'totalUsers', 'activeBorrowings'));
        }

        // For regular user, maybe show their active borrowings count?
        $myActiveBorrowings = Borrowing::where('user_id', auth()->id())
            ->where('status', 'dipinjam')
            ->count();
            
        return view('dashboard', compact('myActiveBorrowings'));
    }
}
