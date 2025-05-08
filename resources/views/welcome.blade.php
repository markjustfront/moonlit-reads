@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1 class="text-3xl font-bold mb-4" role="heading">Welcome to Moonlit Reads</h1>
        <p>Manage your book collection with ease.</p>
        @auth
            <a href="{{ route('books.index') }}" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">View Books</a>
        @else
            <a href="{{ route('login') }}" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Login</a>
        @endauth
    </div>
@endsection