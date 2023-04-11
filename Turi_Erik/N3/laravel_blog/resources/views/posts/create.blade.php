<x-guest-layout :categories=$categories>
    
    <h2>Új bejegyzés</h2>
    <form action="{{ route('posts.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    Cím: <input type="text" name="title" value="{{ old('title') }}"><br>
    @error('title')
        {{ $message }}
    @enderror

    Tartalom:<br>
    <textarea name="content" rows="5" cols="40"></textarea><br>

    Dátuma: <input type="date" name="date"><br>

    Publikálva: <input type="checkbox" name="public"><br>

    Kép: <input type="file" name="file"><br>

    <h2>Kategóriák</h2>
    @foreach($categories as $c)
        <input type="checkbox" name="cats[]" value="{{ $c -> id }}">{{$c -> name}}<br>
    @endforeach
    <button type="submit" class="p-2 inline-block bg-sky-900 hover:bg-sky-700 text-white">Mentés</button>

    </form>
</x-guest-layout>