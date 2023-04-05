<x-guest-layout :categories="$categories">
    <h2>{{ $post -> title }} szerkesztése</h2>

    <form action="{{ route('posts.update', ['post' => $post]) }}" method="POST">
        @csrf
        @method('PATCH')
        Cím: <input type="text" name="title" value="{{ old('title', $post -> title) }}"><br>
        @error('title')
            {{ $message }}<br>
        @enderror

        Tartalom:<br>
        <textarea name="content" cols="80" rows="5">{{ old('content', $post -> content) }}</textarea><br>
        @error('content')
            {{ $message }}<br>
        @enderror

        Dátum: <input type="date" name="date" value="{{ old('date', $post -> date) }}"><br>
        @error('date')
            {{ $message }}<br>
        @enderror

        Publikálva: <input type="checkbox" name="published" @if($post -> published) checked @endif><br>

        <h2>Kategóriák</h2>
        @foreach($categories as $c)
        <input type="checkbox" name="cats[]" value="{{ $c -> id }}">{{$c -> name}}<br>
        @endforeach

        <button type="submit" class="p-2 inline-block bg-sky-900 hover:bg-sky-700 text-white">Mentés</button>
    </form>
</x-guest-layout>