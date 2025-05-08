<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moonlit Reads</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/vue.js') }}"></script>
    <script src="{{ asset('js/axios.js') }}"></script>
</head>
<body class="bg-gray-100 text-gray-900">
    <header class="bg-blue-900 text-white p-4" role="banner">
        <nav class="flex justify-center space-x-4" aria-label="Main navigation">
            <a href="{{ url('/') }}" class="hover:underline">Home</a>
            @auth
                <a href="{{ route('books.index') }}" class="hover:underline">Books</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="hover:underline">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="hover:underline">Login</a>
                <a href="{{ route('register') }}" class="hover:underline">Register</a>
            @endauth
        </nav>
    </header>
    <main class="max-w-7xl mx-auto p-6">
        @yield('content')
    </main>
</body>
</html>