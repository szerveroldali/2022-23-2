<x-guest-layout :categories="$categories">
    
    @can('delete', $post)
    <form action="{{ route('posts.destroy', ['post' => $post ])}}" method="POST">
        @csrf
        @method('DELETE')
        <button class="p-2 inline-block mb-4 bg-red-900 hover:bg-red-700 text-white" type="submit">Törlés</button>
    </form>
    @endcan

    <h2>{{ $post -> title }}</h2>
    {{ $post -> content }}
</x-guest-layout>