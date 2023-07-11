<x-layout title="Login">
    <form method="post" action="{{ route('users.store') }}"  class="mb-2">
        @csrf
        <div class="form-group">
            <label for="name" class="form-label">Nome</label>
            <input type="name" name="name" id="name" class="form-control">
        </div>

        <div class="form-group">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Senha</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <button class="btn btn-warning mt-3">Registrar</button>
    </form>
</x-layout>
