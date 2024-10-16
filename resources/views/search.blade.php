<!DOCTYPE html>
<x-app-layout>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div class="flex justify-end p-4">
    <div class="buttons">
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
    </div>
</div>

<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex justify-center mt-8">
    {{ __('COVID vaccine registration system') }}
</h2>
<div class="search-bar flex justify-center mt-8">
    <form method="GET" action="{{ route('search') }}" class="w-full max-w-md flex">
        <input type="text" name="query" placeholder="Search..." class="w-full"/>
        <button type="submit" class="ml-2">Search</button>
    </form>
</div>

@if(!@empty($data['user']))
    <div class="mt-8 flex justify-center">
        <table class="min-w-full bg-white dark:bg-gray-800">
            <thead>
            <tr>
                <th class="py-2 px-4 border-b-2 border-gray-200 dark:border-gray-700 text-left text-sm font-semibold text-white-600 dark:text-gray-200">
                    Nid
                </th>
                <th class="py-2 px-4 border-b-2 border-gray-200 dark:border-gray-700 text-left text-sm font-semibold text-white-600 dark:text-gray-200">
                    Name
                </th>
                <th class="py-2 px-4 border-b-2 border-gray-200 dark:border-gray-700 text-left text-sm font-semibold text-white-600 dark:text-gray-200">
                    Email
                </th>
                <th class="py-2 px-4 border-b-2 border-gray-200 dark:border-gray-700 text-left text-sm font-semibold text-white-600 dark:text-gray-200">
                    Vaccine Center
                </th>
                <th class="py-2 px-4 border-b-2 border-gray-200 dark:border-gray-700 text-left text-sm font-semibold text-white-600 dark:text-gray-200">
                    Vaccination date
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">{{ $data['user']->nid }}</td>
                <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">{{ $data['user']->name }}</td>
                <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">{{ $data['user']->email }}</td>
                <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">{{ $data['user']->vaccine_center?->name?? 'N/A' }}</td>
                <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">{{ $data['user']->schedule?->date?? 'N/A' }}</td>
            </tr>
            </tbody>
        </table>
    </div>
@elseif($data['searched'])
    <p class="text-center text-gray-500">No content found.</p>
@else
    <p class="text-center text-gray-500">Search with NID</p>
@endif

</body>
</html>
    </x-app-layout>
