<?php
use App\Http\Controllers\BookController;
use App\Http\Controllers\Crud\BookCrudController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/books', [BookCrudController::class, 'index'])->name('books.index');
    Route::get('/books/all', [BookCrudController::class, 'all'])->name('books.all'); // For Axios
    Route::post('/books', [BookCrudController::class, 'store'])->name('books.store');
    Route::get('/books/{book}', [BookCrudController::class, 'show'])->name('books.show');
    Route::put('/books/{book}', [BookCrudController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}', [BookCrudController::class, 'destroy'])->name('books.destroy');
    Route::get('/books/search', [BookController::class, 'search'])->name('books.search');
});