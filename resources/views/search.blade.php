<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <!-- Load CSS from app.css via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

<!-- Buttons for Login and Register at the top -->
<div class="flex justify-end p-4">
    <div class="buttons">
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
    </div>
</div>

<!-- Search Bar in the middle -->
<div class="search-bar flex justify-center mt-8">
    <form method="GET" action="{{ route('search') }}" class="w-full max-w-md flex">
        <input type="text" name="query" placeholder="Search..." class="w-full" />
        <button type="submit" class="ml-2">Search</button>
    </form>
</div>

<!-- Search results or No content message -->
@if(isset($results) && count($results) > 0)
    <div class="mt-8 flex justify-center">
        <table class="min-w-full bg-white">
            <thead>
            <tr>
                <th class="py-2 px-4 border-b">NID</th>
                <th class="py-2 px-4 border-b">Name</th>
                <th class="py-2 px-4 border-b">Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($results as $result)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $result->nid }}</td>
                    <td class="py-2 px-4 border-b">{{ $result->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $result->status }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@else
    <p class="text-center text-gray-500">No content found.</p>
@endif

</body>
</html>
