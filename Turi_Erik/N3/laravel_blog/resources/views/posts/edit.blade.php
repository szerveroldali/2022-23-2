<x-guest-layout :categories=$categories>
    
    <h2>{{ $post -> title }} szerkesztése</h2>
    <form action="{{ route('posts.update', ['post' => $post ])}}" method="POST">
    @csrf
    @method('PATCH')
    Cím: <input type="text" name="title" value="{{ old('title', $post -> title ) }}"><br>
    @error('title')
        {{ $message }}
    @enderror

    Tartalom:<br>
    <textarea name="content" rows="5" cols="40">{{ old('content', $post -> content ) }}</textarea><br>

    Dátuma: <input type="date" name="date" value="{{ old('date', $post -> date ) }}"><br>

    Publikálva: <input type="checkbox" name="public"><br>

    <h2>Kategóriák</h2>
    @foreach($categories as $c)
        <input type="checkbox" name="cats[]" value="{{ $c -> id }}" {{ in_array($c -> id, old('cats', $post -> categories -> pluck('id') -> toArray()))  ? 'checked' : '' }} >{{$c -> name}}<br>
    @endforeach
    <button type="submit" class="p-2 inline-block bg-sky-900 hover:bg-sky-700 text-white">Mentés</button>

    </form>
</x-guest-layout>