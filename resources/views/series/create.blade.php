<x-layout title="Nova Série">
    <form action="/series/salvar" method="post">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nome da série</label>
        <input type="text" class="form-control" id="name" name="name" aria-describedby="serieHelp">
        <div id="serieHelp" class="form-text">Digite o nome da série preferida.</div>
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</x-layout>
