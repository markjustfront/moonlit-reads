<?php
namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookCrudController extends Controller
{
    public function index()
    {
        return view('books.index');
    }

    public function all()
    {
        return response()->json(Book::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
        ]);

        $book = Book::create($request->all());
        return response()->json(['message' => 'Book added.', 'book' => $book], 201);
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
        ]);

        $book->update($request->all());
        return response()->json(['message' => 'Book updated.', 'book' => $book]);
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json(['message' => 'Book deleted.']);
    }
}