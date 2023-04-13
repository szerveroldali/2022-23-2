demo

{{-- @for ($i = 0; $i < 10; $i++)
    <p>The current value is {{ $i }}</p>
@endfor --}}

@php
    $fruits = ['alma', 'körte'];
    // $fruits = [];
@endphp

@forelse ($fruits as $fruit)
    <p>{{ $loop->iteration }}. {{ $fruit }}</p>
@empty
    <p>Nincsenek gyümölcsök</p>
@endforelse
