<x-guest-layout :categories=$categories>

<h2>Minden bejegyzés</h2>

<div class="grid grid-cols-3 gap-3">
@forelse ($posts as $p)
    <div class="border border-gray-400 col-span-3 lg:col-span-1">
        <h3>{{ $p -> title }}</h3>
        <i>{{ $p -> author -> name }}</i><br>
        {{ Str::limit($p -> content, 80) }}
    </div>
@empty
    Nincsenek bejegyzések.    
@endforelse
</div>

</x-guest-layout>