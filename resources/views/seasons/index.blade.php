<x-layout title="Temporadas de {!! $series->nome !!}">
    <ul class="list-group">
        @foreach ($seasons as $season)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                     
                    @auth <a href="{{ route('episodes.index', $season->id) }}" > @endauth
                        Temporada {{ $season->number }}
                    @auth </a> @endauth
                
                @php
                    $count=0;
                    $allWatched = false;
                    $partial = false;

                    if ( $season->numberOfWatchedEpisodes() == $season->episodes->count() )
                        $allWatched = true;
                    else
                        $allWatched = false;

                    if ( $season->numberOfWatchedEpisodes() > 0 )
                        $partial = true;

                @endphp

                <span class="badge @if ($allWatched) bg-success @elseif ($partial) bg-warning  @else  bg-secondary @endif">
                    {{ $season->numberOfWatchedEpisodes() }} / {{ $season->episodes->count() }}
                </span>
            </li>
        @endforeach
    </ul>
</x-layout>

