<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="container mx-auto">
            <div class="grid grid-cols-4 gap-6">
                <div class="col-span-4">
                    <h1 class="text-5xl text-sky-700">Laravel blogocska</h1>
                </div>
                <div class="col-span-4 lg:col-span-3">
                    {{ $slot }}
                </div>
                <div class="col-span-4 lg:col-span-1">
                    <h2>Kategóriák</h2>
                    @foreach ($categories as $c)
                     {{ $c -> name }}
                    @endforeach
                </div>
            </div>
        </div>
    </body>
</html>
