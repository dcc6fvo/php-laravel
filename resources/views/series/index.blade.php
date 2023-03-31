<x-layout title="Séries">
    <ul class="list-group">
        @foreach ($series as $serie)
        <li class="list-group-item d-flex justify-content-between align-items-center">
        <span class="text">{{ $serie->name }}</span>
        <form action="{{ route('series.destroy', $serie->id) }}" method="post" class="ms-2">
        @csrf
        @method('DELETE')
            <button class="btn btn-danger btn-sm">
                X
            </button>
        </form></li>
        @endforeach
    </ul>
    <div class='mt-3'>
        <a href="{{route('series.create')}}" class="btn btn-dark mb-2">Adicionar</a>
    </div>
</x-layout>
