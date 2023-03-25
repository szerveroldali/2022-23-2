<h1>Bejegyzések listája</h1>

@forelse($macska as $m)
    {{ $m -> title }}<br>
@empty
    Nincsenek bejegyzések.
@endforelse