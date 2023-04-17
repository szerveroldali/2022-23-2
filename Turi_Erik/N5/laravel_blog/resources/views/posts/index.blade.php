<x-guest-layout :categories=$categories>

<h2>Minden bejegyzés</h2>

@if (Session::get('post-created'))
<div class="text-2xl text-center bg-green-800 rounded-lg shadow-md shadow-green-500 mb-4 text-white">
A bejegyzés sikeresen létrejött!
</div>
@endif

<div class="grid grid-cols-3 gap-3">
@forelse ($posts as $p)
    <div class="border border-gray-400 col-span-3 lg:col-span-1">
        <div class="w-full">
            @if ($p -> filename === null)
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTyYrdd3SP269hk2qDz6WfR64Uh-n8LbC3t1uSnzzSV2nxGZj-s2IaLLHGYvt053ZeCTOk&usqp=CAU">
            @else
            <img src="{{ Storage::url('images/' . $p -> filename) }}">
            @endif
        </div>
        <h3>{{ $p -> title }}</h3>
        <i>{{ $p -> author -> name }}</i><br>
        {{ Str::limit($p -> content, 80) }}
        <a href="{{ route('posts.show', ['post' => $p]) }}" class="block p-2 bg-sky-700 hover:bg-sky-900 text-white">Elolvasom</a> 
    </div>
@empty
    Nincsenek bejegyzések.    
@endforelse
</div>

{{ $posts -> links() }}

</x-guest-layout>