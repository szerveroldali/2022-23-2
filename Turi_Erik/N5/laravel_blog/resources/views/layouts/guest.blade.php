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
                    <h1>Laravel blogocska</h1>
                    @guest
                    Vendég nézet.
                    <a href="{{ route('login') }}">Bejelentkezés</a>
                    <a href="{{ route('register') }}">Regisztráció</a>
                    @endguest
                    @auth
                    Szia, {{ Auth::user() -> name }}!
                    <form action="{{ route('logout')}}" method="POST">
                        @csrf
                        <button type="submit" class="inline-block p-2 mb-4 bg-red-700 hover:bg-red-900 text-white">Kijelentkezés</button>
                    </form>
                    @endauth
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
