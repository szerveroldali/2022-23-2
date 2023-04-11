<x-guest-layout :categories="$categories">
    <h2>Minden bejegyzés</h2>

    @if (Session::get('post-created'))
        <div class="w-full text-center bg-green-700 mb-4 rounded-md text-white">
            A bejegyzés sikeresen létrejött!
        </div>
    @endif

    <div class="grid grid-cols-3 gap-2">
        @forelse($posts as $p)
        <div class="border border-gray-400 text-justify">
            @if ($p -> filename !== null)
                <img src="{{ Storage::url('images/'.$p -> filename) }}">
            @else
                <img src="https://pbs.twimg.com/media/FToChjLWYAMROZn.jpg">
            @endif
            <div class="p-2">
                <h3>{{ $p -> title }}</h3>
                <i>{{ $p -> author -> name }}</i><br>
                {{ $p -> content }}
                <a href="{{ route('posts.show', ['post' => $p] ) }}" class="p-2 block bg-sky-900 hover:bg-sky-700 text-white">Elolvasom</a>
            </div>
        </div>
        @empty
         @endforelse
    </div>
    {{ $posts -> links() }}
    
</x-guest-layout>