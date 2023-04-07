<x-layout title="Séries">
    
    @isset($mensagemSucesso)
    <div class="alert alert-success" role="alert">
        {{ $mensagemSucesso }}
    </div>
    @endisset

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <ul class="list-group">
        @foreach ($series as $serie)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <span class="text" >{{ $serie->name }}</span>     

            <span class="d-flex">
        
                <a href="{{ route('series.edit', $serie->id) }}" 
                    class="btn btn-primary btn-sm">E
                </a>
                
                <form action="{{ route('series.destroy', $serie->id) }}" method="post" class="ms-2">
                @csrf
                @method('DELETE')
                    <button class="btn btn-danger btn-sm">X</button>
                </form>
            </span>
        </li>
        @endforeach
    </ul>
    <div class='mt-3'>
        <a href="{{route('series.create')}}" class="btn btn-dark mb-2">Adicionar</a>
    </div>
</x-layout>
