<x-layout title="Séries" :mensagem-sucesso="$mensagemSucesso">
    
    @auth
    <div class="container-fluid">
        <div class="row">
          <div class="col-12 d-flex justify-content-end">
            <a href="{{ route('series.create') }}" class="btn btn-primary mb-2">Adicionar</i></a>
          </div>
        </div>
    </div>
    @endauth

    <ul class="list-group">
        @foreach ($series as $serie)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                @php
                    if ( $serie->cover && file_exists(public_path('storage/'.$serie->cover)) )
                        $image = 'storage/'.$serie->cover;
                    else
                        $image = 'storage/notfound.png';

                @endphp
                <img src="{{ asset($image) }}" alt="{{ $serie->nome }}" class="thumbnail me-3">
                <a href="{{ route('seasons.index', $serie->id) }}">     
                    {{ $serie->nome }}
                </a>
            </div>

            @auth
            <span class="d-flex">
                <a href="{{ route('series.edit', $serie->id) }}" class="btn btn-warning">
                    <i class="bi bi-pencil-square"></i>
                </a>

                <form action="{{ route('series.destroy', $serie->id) }}" method="post" class="ms-2">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </form>
            </span>
            @endauth

        </li>
        @endforeach
    </ul>
</x-layout>
