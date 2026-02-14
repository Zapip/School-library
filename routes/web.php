<?php

use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\User\BookController as UserBookController;
use App\Http\Controllers\User\BorrowingController as UserBorrowingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('books', AdminBookController::class);
        Route::get('/borrowings', [\App\Http\Controllers\Admin\BorrowingController::class, 'index'])->name('borrowings.index');
        Route::post('/borrowings/{borrowing}/return', [TransactionController::class, 'returnBook'])->name('borrowings.return');
        Route::get('/requests', [\App\Http\Controllers\Admin\BookRequestController::class, 'index'])->name('requests.index');
        Route::get('/requests', [\App\Http\Controllers\Admin\BookRequestController::class, 'index'])->name('requests.index');
        Route::patch('/requests/{bookRequest}', [\App\Http\Controllers\Admin\BookRequestController::class, 'update'])->name('requests.update');
        
        // Menfess Routes
        Route::get('/menfess', [\App\Http\Controllers\Admin\MenfessController::class, 'index'])->name('menfess.index');
        Route::patch('/menfess/{menfess}', [\App\Http\Controllers\Admin\MenfessController::class, 'update'])->name('menfess.update');
        Route::delete('/menfess/{menfess}', [\App\Http\Controllers\Admin\MenfessController::class, 'delete'])->name('menfess.destroy');
    });

    // User Routes
    Route::get('/books', [UserBookController::class, 'index'])->name('books.index');
    Route::post('/borrow', [TransactionController::class, 'borrow'])->name('borrow.store');
    Route::get('/my-borrowings', [UserBorrowingController::class, 'index'])->name('borrowings.index');
    
    // User Request Routes
    Route::resource('requests', \App\Http\Controllers\User\BookRequestController::class)->only(['index', 'create', 'store']);

    // Menfess Routes
    Route::get('/menfess', [\App\Http\Controllers\User\MenfessController::class, 'index'])->name('menfess.index');
    Route::post('/menfess', [\App\Http\Controllers\User\MenfessController::class, 'store'])->name('menfess.store');
    Route::post('/menfess/{menfess}/report', [\App\Http\Controllers\User\MenfessController::class, 'report'])->name('menfess.report');
});

require __DIR__.'/auth.php';
