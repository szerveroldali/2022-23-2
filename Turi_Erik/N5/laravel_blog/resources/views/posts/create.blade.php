<x-guest-layout :categories=$categories>

    <h2>Új bejegyzés</h2>
    
    <form method="POST" action="{{ route('posts.store') }}">
    @csrf
    Cím: <input type="text" name="title" value="{{ old('title') }}"><br>
    @error('title')
       {{ $message }}<br>
    @enderror

    Tartalom:<br>
    <textarea name="content"></textarea><br>
    @error('content')
       {{ $message }}<br>
    @enderror

    Dátum: <input type="date" name="date"><br>
    @error('date')
       {{ $message }}<br>
    @enderror

    Publikálva: <input type="checkbox" name="published"><br>

    <h2>Kategóriák</h2>
    @foreach ($categories as $c)
        <input type="checkbox" name="cats[]" value="{{ $c -> id }}">{{ $c -> name}}<br>
    @endforeach

    <button type="submit" class="inline-block p-2 bg-sky-700 hover:bg-sky-900 text-white">Mentés</button>
    </form>
    </x-guest-layout>