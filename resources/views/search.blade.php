<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <!-- Load CSS from app.css via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">
<div class="container text-center max-w-lg">
    <div class="buttons mt-6">
        <a href="{{ route('login') }}"
           class="inline-block bg-gray-800 text-white px-6 py-2 rounded-md hover:bg-gray-700 mr-4">Login</a>
        <a href="{{ route('register') }}"
           class="inline-block bg-gray-800 text-white px-6 py-2 rounded-md hover:bg-gray-700">Register</a>
    </div>
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Welcome to Laravel</h1>

    <!-- Search Form -->
    <div class="search-bar bg-white p-6 rounded-lg shadow-md">
        <form method="GET" action="{{ route('search') }}">
            <input name="query" class="w-4/5 p-2 rounded-md border-gray-300 mr-3" type="text"
                   placeholder="Enter your name or registration ID"/>
            <button class="bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700" type="submit">Search</button>
        </form>
    </div>
    @if(isset($results) && $results->isNotEmpty())
        <div class="mt-6 bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-bold mb-4">Search Results:</h2>
            <ul>
                @foreach($results as $result)
                    <li class="border-b py-2">
                        <p><strong>Name:</strong> {{ $result->name }}</p>
                        <p><strong>National ID:</strong> {{ $result->nid }}</p>
                        <p><strong>Status:</strong> {{ $result->status }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
    @elseif(isset($results))
        <p class="text-center text-red-500 mt-4">No results found for your search.</p>
    @endif

</div>
</body>
</html>
