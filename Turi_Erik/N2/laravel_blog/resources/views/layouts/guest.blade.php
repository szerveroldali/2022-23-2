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
                    @auth
                        Üdvözölöm, {{ Auth::user() -> name }}!
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="p-2 inline-block mb-4 bg-red-900 hover:bg-red-700 text-white" type="submit">Kijelentkezés</button>
                        </form>
                    @endauth
                    @guest
                        Üdvözölöm, Vendég!
                    @endguest
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
