<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class BorrowingService
{
    public function borrowBook(User $user, Book $book, string $dueDate)
    {
        if ($book->stok < 1) {
            throw new Exception("Buku tidak tersedia (stok kosong).");
        }

        // Check if user already borrowed this book and hasn't returned it
        $isBorrowed = Borrowing::where('user_id', $user->id)
            ->where('book_id', $book->id)
            ->where('status', 'dipinjam')
            ->exists();

        if ($isBorrowed) {
            throw new Exception("Anda sedang meminjam buku ini. Harap kembalikan terlebih dahulu sebelum meminjam lagi.");
        }

        return DB::transaction(function () use ($user, $book, $dueDate) {
            $book->decrement('stok');

            return Borrowing::create([
                'user_id' => $user->id,
                'book_id' => $book->id,
                'tanggal_pinjam' => now(),
                'tanggal_jatuh_tempo' => $dueDate,
                'status' => 'dipinjam',
            ]);
        });
    }

    public function returnBook(Borrowing $borrowing)
    {
        if ($borrowing->status === 'dikembalikan') {
            return $borrowing;
        }

        return DB::transaction(function () use ($borrowing) {
            $borrowing->book->increment('stok');
            
            $tanggal_kembali = now();
            $denda = 0;

            if ($tanggal_kembali->gt($borrowing->tanggal_jatuh_tempo)) {
                $hari_terlambat = ceil($tanggal_kembali->diffInDays($borrowing->tanggal_jatuh_tempo));
                $denda = $hari_terlambat * 1000;
            }

            $borrowing->update([
                'status' => 'dikembalikan',
                'tanggal_kembali' => $tanggal_kembali,
                'denda' => $denda,
            ]);

            return $borrowing;
        });
    }
}
