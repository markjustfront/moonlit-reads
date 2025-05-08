@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4" role="heading">Books</h1>

    <!-- Search Bar -->
    <div id="search-app" class="mb-6">
        <input
            v-model="query"
            @input="searchBooks"
            type="text"
            placeholder="Search by title or author..."
            class="w-full p-2 border rounded"
            aria-label="Search books"
        >
        <ul v-if="results.length" class="mt-2 border p-2">
            <li v-for="book in results" :key="book.id" class="p-1">
                <book-item :book="book"></book-item>
            </li>
        </ul>
    </div>

    <!-- Carousel -->
    <div class="carousel mb-6" role="region" aria-label="Featured books carousel">
        <div class="carousel-items flex">
            @foreach ($books->take(3) as $book)
                <div class="carousel-item min-w-full text-center p-4 bg-gray-200 border">
                    <h3 class="text-lg font-semibold">{{ $book->title }}</h3>
                    <p>{{ $book->author }}</p>
                </div>
            @endforeach
        </div>
        <button class="prev absolute top-1/2 left-0 transform -translate-y-1/2 bg-gray-800 text-white p-2" aria-label="Previous slide">Prev</button>
        <button class="next absolute top-1/2 right-0 transform -translate-y-1/2 bg-gray-800 text-white p-2" aria-label="Next slide">Next</button>
    </div>

    <!-- Slider -->
    <div class="mb-6">
        <label for="price-slider" class="block mb-2">Filter by Price: <span id="price-value">0</span></label>
        <input
            type="range"
            id="price-slider"
            min="0"
            max="50"
            value="0"
            class="w-full"
            aria-label="Price filter"
        >
    </div>

    <!-- Book List -->
    <div class="grid grid-cols-1 gap-4">
        @foreach ($books as $book)
            <div class="p-4 bg-white border rounded">
                <h3 class="text-lg font-semibold">{{ $book->title }}</h3>
                <p>{{ $book->author }} - ${{ $book->price }}</p>
                <a href="{{ route('books.show', $book) }}" class="text-blue-600 hover:underline">View</a>
                <a href="{{ route('books.edit', $book) }}" class="text-blue-600 hover:underline">Edit</a>
                <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </div>
        @endforeach
    </div>
    <a href="{{ route('books.create') }}" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add Book</a>

    <script>
        const { createApp } = Vue;
        createApp({
            data() {
                return {
                    query: '',
                    results: [],
                };
            },
            methods: {
                searchBooks() {
                    axios.get('/books/search?query=' + this.query)
                        .then(response => {
                            this.results = response.data;
                        });
                },
            },
        }).component('book-item', {
            props: ['book'],
            template: `<div>{{ book.title }} by {{ book.author }}</div>`,
        }).mount('#search-app');

        // Carousel
        const carousel = document.querySelector('.carousel-items');
        const items = document.querySelectorAll('.carousel-item');
        let current = 0;
        document.querySelector('.next').addEventListener('click', () => {
            current = (current + 1) % items.length;
            carousel.style.transform = `translateX(-${current * 100}%)`;
        });
        document.querySelector('.prev').addEventListener('click', () => {
            current = (current - 1 + items.length) % items.length;
            carousel.style.transform = `translateX(-${current * 100}%)`;
        });

        // Slider
        const slider = document.getElementById('price-slider');
        const priceValue = document.getElementById('price-value');
        slider.addEventListener('input', () => {
            priceValue.textContent = slider.value;
        });
    </script>
@endsection