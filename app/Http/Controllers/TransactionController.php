<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBorrowingRequest;
use App\Models\Book;
use App\Models\Borrowing;
use App\Services\BorrowingService;
use Exception;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct(protected BorrowingService $borrowingService)
    {
    }

    public function borrow(StoreBorrowingRequest $request)
    {
        $book = Book::findOrFail($request->book_id);
        
        try {
            $this->borrowingService->borrowBook($request->user(), $book, $request->tanggal_jatuh_tempo);
            return redirect()->back()->with('success', 'Buku berhasil dipinjam.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function returnBook(Borrowing $borrowing)
    {
        // Authorization check: only admin can process return
        // This should ideally be in a Policy, but for simplicity:
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        try {
            $this->borrowingService->returnBook($borrowing);
            return redirect()->back()->with('success', 'Buku berhasil dikembalikan.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
