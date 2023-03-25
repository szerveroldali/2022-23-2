<h1>Bejegyzések listája</h1>

@forelse($bejegyzesek as $b)
    {{ $b -> title }} <br>
@empty
    Nincsenek bejegyzések.
@endforelse