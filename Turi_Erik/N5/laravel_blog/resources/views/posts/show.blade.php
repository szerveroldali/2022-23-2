<x-guest-layout :categories=$categories>

    @can('delete', $post)
    <form action="{{ route('posts.destroy', ['post' => $post])}}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="inline-block p-2 mb-4 bg-red-700 hover:bg-red-900 text-white">Törlés</button>
    </form>
    @endcan

    <h2>{{ $post -> title }} </h2>
    
    Szerző: {{ $post -> author -> name }}<br>
    Kategóriák: 
    @forelse ($post -> categories as $c)
      {{ $c -> name }}
    @empty
      Nincs! :'(
    @endforelse
    <br><br>
    {{ $post -> content }}

    </x-guest-layout>