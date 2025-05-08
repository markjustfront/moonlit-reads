<?php
use App\Http\Controllers\BookController;
use App\Http\Controllers\Crud\BookCrudController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::resource('books', BookCrudController::class);
    Route::get('books/search', [BookController::class, 'search'])->name('books.search');
});