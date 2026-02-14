<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\BookService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __construct(protected BookService $bookService)
    {
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $books = $this->bookService->getAllBooks($search);
        return view('user.books.index', compact('books', 'search'));
    }

    public function show(\App\Models\Book $book)
    {
        return view('user.books.show', compact('book'));
    }
}
