{{ 4 / 3 }}

@php
  use App\Models\User;
  $users = User::all();  
  $users = [];
@endphp

@if (3 > 4)
    Három nagyobb mint négy.
@else
    Három nem nagyobb mint négy.
@endif

<h2>Felhasználók</h2>

@forelse($users as $u)
    {{ $u -> name}} <br>
@empty
    Nincsenek felhasználók.
@endforelse

@auth

@endauth

@guest
    Vendég vagy.
@endguest

@can('update', $post)
    
@endcan