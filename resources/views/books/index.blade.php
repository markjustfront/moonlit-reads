@extends('layouts.app')

@section('content')
    <div id="books-app" class="space-y-6">
        <h1 class="text-2xl font-bold mb-4" role="heading">Books</h1>

        <!-- Search Bar -->
        <div class="mb-6">
            <input
                v-model="query"
                @input="searchBooks"
                type="text"
                placeholder="Search by title or author..."
                class="w-full p-2 border rounded"
                aria-label="Search books"
            >
            <ul v-if="searchResults.length" class="mt-2 border p-2">
                <li v-for="book in searchResults" :key="book.id" class="p-1">
                    <book-item :book="book"></book-item>
                </li>
            </ul>
        </div>

        <!-- Carousel -->
        <div class="carousel relative mb-6" role="region" aria-label="Featured books carousel">
            <div class="carousel-items flex transition-transform duration-500">
                <div v-for="book in books.slice(0, 3)" :key="book.id" class="carousel-item min-w-full text-center p-4 bg-gray-200 border">
                    <h3 class="text-lg font-semibold">{{ book.title }}</h3>
                    <p>{{ book.author }}</p>
                </div>
            </div>
            <button class="prev absolute top-1/2 left-0 transform -translate-y-1/2 bg-gray-800 text-white p-2" aria-label="Previous slide">Prev</button>
            <button class="next absolute top-1/2 right-0 transform -translate-y-1/2 bg-gray-800 text-white p-2" aria-label="Next slide">Next</button>
        </div>

        <!-- Slider -->
        <div class="mb-6">
            <label for="price-slider" class="block mb-2">Filter by Price: <span id="price-value">{{ priceFilter }}</span></label>
            <input
                type="range"
                id="price-slider"
                v-model="priceFilter"
                min="0"
                max="50"
                class="w-full"
                aria-label="Price filter"
            >
        </div>

        <!-- Book List -->
        <div class="grid grid-cols-1 gap-4">
            <div v-for="book in filteredBooks" :key="book.id" class="p-4 bg-white border rounded">
                <h3 class="text-lg font-semibold">{{ book.title }}</h3>
                <p>{{ book.author }} - ${{ book.price }}</p>
                <a :href="'/books/' + book.id" class="text-blue-600 hover:underline">View</a>
                <button @click="openEditModal(book)" class="text-blue-600 hover:underline">Edit</button>
                <button @click="deleteBook(book.id)" class="text-red-600 hover:underline">Delete</button>
            </div>
        </div>
        <button @click="openCreateModal" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add Book</button>

        <!-- Create Modal -->
        <div v-if="showCreateModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center" role="dialog" aria-label="Add book modal">
            <div class="bg-white p-6 rounded max-w-md w-full">
                <h2 class="text-xl font-bold mb-4">Add Book</h2>
                <form @submit.prevent="createBook">
                    <div class="mb-4">
                        <label for="create-title" class="block">Title</label>
                        <input v-model="newBook.title" id="create-title" type="text" class="w-full p-2 border rounded" required aria-required="true">
                    </div>
                    <div class="mb-4">
                        <label for="create-author" class="block">Author</label>
                        <input v-model="newBook.author" id="create-author" type="text" class="w-full p-2 border rounded" required aria-required="true">
                    </div>
                    <div class="mb-4">
                        <label for="create-description" class="block">Description</label>
                        <textarea v-model="newBook.description" id="create-description" class="w-full p-2 border rounded"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="create-price" class="block">Price</label>
                        <input v-model="newBook.price" id="create-price" type="number" step="0.01" class="w-full p-2 border rounded" required aria-required="true">
                    </div>
                    <div class="mb-4">
                        <label for="create-category" class="block">Category</label>
                        <select v-model="newBook.category" id="create-category" class="w-full p-2 border rounded" required aria-required="true">
                            <option value="Fiction">Fiction</option>
                            <option value="Non-Fiction">Non-Fiction</option>
                        </select>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" @click="showCreateModal = false" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Cancel</button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Modal -->
        <div v-if="showEditModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center" role="dialog" aria-label="Edit book modal">
            <div class="bg-white p-6 rounded max-w-md w-full">
                <h2 class="text-xl font-bold mb-4">Edit Book</h2>
                <form @submit.prevent="updateBook">
                    <div class="mb-4">
                        <label for="edit-title" class="block">Title</label>
                        <input v-model="editBook.title" id="edit-title" type="text" class="w-full p-2 border rounded" required aria-required="true">
                    </div>
                    <div class="mb-4">
                        <label for="edit-author" class="block">Author</label>
                        <input v-model="editBook.author" id="edit-author" type="text" class="w-full p-2 border rounded" required aria-required="true">
                    </div>
                    <div class="mb-4">
                        <label for="edit-description" class="block">Description</label>
                        <textarea v-model="editBook.description" id="edit-description" class="w-full p-2 border rounded"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="edit-price" class="block">Price</label>
                        <input v-model="editBook.price" id="edit-price" type="number" step="0.01" class="w-full p-2 border rounded" required aria-required="true">
                    </div>
                    <div class="mb-4">
                        <label for="edit-category" class="block">Category</label>
                        <select v-model="editBook.category" id="edit-category" class="w-full p-2 border rounded" required aria-required="true">
                            <option value="Fiction">Fiction</option>
                            <option value="Non-Fiction">Non-Fiction</option>
                        </select>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" @click="showEditModal = false" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Cancel</button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const { createApp } = Vue;
        createApp({
            data() {
                return {
                    books: [],
                    searchResults: [],
                    query: '',
                    priceFilter: 0,
                    showCreateModal: false,
                    showEditModal: false,
                    newBook: { title: '', author: '', description: '', price: 0, category: 'Fiction' },
                    editBook: {},
                };
            },
            computed: {
                filteredBooks() {
                    return this.books.filter(book => book.price <= this.priceFilter || this.priceFilter == 0);
                },
            },
            methods: {
                fetchBooks() {
                    axios.get('/books/all')
                        .then(response => { this.books = response.data; });
                },
                searchBooks() {
                    axios.get('/books/search?query=' + this.query)
                        .then(response => { this.searchResults = response.data; });
                },
                openCreateModal() {
                    this.newBook = { title: '', author: '', description: '', price: 0, category: 'Fiction' };
                    this.showCreateModal = true;
                },
                createBook() {
                    axios.post('/books', this.newBook)
                        .then(response => {
                            this.books.push(response.data.book);
                            this.showCreateModal = false;
                            alert(response.data.message);
                        });
                },
                openEditModal(book) {
                    this.editBook = { ...book };
                    this.showEditModal = true;
                },
                updateBook() {
                    axios.put(`/books/${this.editBook.id}`, this.editBook)
                        .then(response => {
                            const index = this.books.findIndex(b => b.id === this.editBook.id);
                            this.books[index] = response.data.book;
                            this.showEditModal = false;
                            alert(response.data.message);
                        });
                },
                deleteBook(id) {
                    if (confirm('Are you sure?')) {
                        axios.delete(`/books/${id}`)
                            .then(response => {
                                this.books = this.books.filter(book => book.id !== id);
                                alert(response.data.message);
                            });
                    }
                },
            },
            mounted() {
                this.fetchBooks();
            },
        }).component('book-item', {
            props: ['book'],
            template: `<div>{{ book.title }} by {{ book.author }}</div>`,
        }).mount('#books-app');

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
    </script>
@endsection