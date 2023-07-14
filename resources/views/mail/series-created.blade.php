<x-mail::message>

# A série {{ $nomeSerie }} foi criada
A série {{ $nomeSerie }} foi criada com {{ $qtdSeasons }} temporadas e {{ $qtdEpisodes }} episódios.

Acesse aqui: @component('mail::button', ['url' => route('seasons.index', $idSerie)])
    Ver série @endcomponent
 
</x-mail::message>