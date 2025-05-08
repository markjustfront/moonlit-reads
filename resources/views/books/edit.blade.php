@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4" role="heading">Edit Book</h1>
    <form action="{{ route('books.update', $book) }}" method="POST" class="max-w-md mx-auto space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label for="title" class="block">Title</label>
            <input type="text" name="title" id="title" value="{{ $book->title }}" class="w-full p-2 border rounded" required aria-required="true">
            @error('title') <p class="text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="author" class="block">Author</label>
            <input type="text" name="author" id="author" value="{{ $book->author }}" class="w-full p-2 border rounded" required aria-required="true">
            @error('author') <p class="text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="description" class="block">Description</label>
            <textarea name="description" id="description" class="w-full p-2 border rounded">{{ $book->description }}</textarea>
        </div>
        <div>
            <label for="price" class="block">Price</label>
            <input type="number" name="price" id="price" step="0.01" value="{{ $book->price }}" class="w-full p-2 border rounded" required aria-required="true">
            @error('price') <p class="text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="category" class="block">Category</label>
            <select name="category" id="category" class="w-full p-2 border rounded" required aria-required="true">
                <option value="Fiction" {{ $book->category == 'Fiction' ? 'selected' : '' }}>Fiction</option>
                <option value="Non-Fiction" {{ $book->category == 'Non-Fiction' ? 'selected' : '' }}>Non-Fiction</option>
            </select>
            @error('category') <p class="text-red-600">{{ $message }}</p> @enderror
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update Book</button>
    </form>
@endsection