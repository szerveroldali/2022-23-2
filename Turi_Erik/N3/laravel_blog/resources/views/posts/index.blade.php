<x-guest-layout :categories=$categories>
<h2>Bejegyzések listája</h2>

@if (Session::get('post-created'))
<div class="w-full text-center bg-green-800 rounded-lg text-white mb-4">
    A bejegyzés létrehozása sikeres!
</div>
@endif

<div class="grid grid-cols-3 gap-2">
@forelse($bejegyzesek as $b)
    <div class="col-span-3 lg:col-span-1 border border-gray-400">
        <img src="{{$b -> filename === null ? 'https://www.angelxp.eu/image/Twitter/animaux/renard04.jpg' : Storage::url('images/'.$b -> filename)  }}">
        <div class="p-2">
            <h3>{{ $b -> title }}</h3>
            <i>{{ $b -> author -> name }}</i><br>
            {{ $b -> content }}
            <a href="{{ route('posts.show', ['post' => $b]) }}" class="p-2 block bg-sky-900 hover:bg-sky-700 text-white">Elolvasom</a>
        </div>
    </div>
@empty
    Nincsenek bejegyzések.
@endforelse
</div>

{{ $bejegyzesek -> links() }}

</x-guest-layout>