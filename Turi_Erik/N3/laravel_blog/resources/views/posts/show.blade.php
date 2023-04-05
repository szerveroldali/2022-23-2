<x-guest-layout :categories=$categories>

    <form action="{{ route('posts.destroy', ['post' => $post]) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="p-2 inline-block mb-4 bg-red-900 hover:bg-red-700 text-white">Törlés</button>
    </form>

    <h2>{{ $post -> title }}</h2>
    <i>{{ $post -> author -> name }}</i><br>
    {{ $post -> content }}
</x-guest-layout>