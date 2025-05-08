@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4" role="heading">{{ $book->title }}</h1>
    <div class="p-4 bg-white border rounded max-w-md mx-auto">
        <p><strong>Author:</strong> {{ $book->author }}</p>
        <p><strong>Price:</strong> ${{ $book->price }}</p>
        <p><strong>Category:</strong> {{ $book->category }}</p>
        <p><strong>Description:</strong> {{ $book->description ?? 'N/A' }}</p>
        <a href="{{ route('books.index') }}" class="text-blue-600 hover:underline">Back to Books</a>
    </div>
@endsection