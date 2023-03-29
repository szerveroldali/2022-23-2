<x-guest-layout :categories=$categories>
    <h2>{{ $post -> title }}</h2>
    <i>{{ $post -> author -> name }}</i><br>
    {{ $post -> content }}
</x-guest-layout>