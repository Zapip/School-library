<?php

namespace App\Services;

use App\Models\Book;

class BookService
{
    public function getAllBooks(string $search = null, int $perPage = 10)
    {
        return Book::query()
            ->when($search, function ($query) use ($search) {
                $query->where('judul', 'like', "%{$search}%")
                      ->orWhere('penulis', 'like', "%{$search}%")
                      ->orWhere('kode_buku', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate($perPage);
    }

    public function createBook(array $data)
    {
        if (isset($data['cover_image']) && $data['cover_image'] instanceof \Illuminate\Http\UploadedFile) {
            $data['cover_image'] = $data['cover_image']->store('books', 'public');
        }
        return Book::create($data);
    }

    public function updateBook(Book $book, array $data)
    {
        if (isset($data['cover_image']) && $data['cover_image'] instanceof \Illuminate\Http\UploadedFile) {
            if ($book->cover_image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($book->cover_image);
            }
            $data['cover_image'] = $data['cover_image']->store('books', 'public');
        }
        
        $book->update($data);
        return $book;
    }

    public function deleteBook(Book $book)
    {
        if ($book->cover_image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($book->cover_image);
        }
        return $book->delete();
    }
}
