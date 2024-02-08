@extends('layouts.app')
@include('admin.includes.alerts')

<div class="form-group">
    <label class="col-sm-12 col-form-label"><h2>Dados Pessoais</h2></label>
    <br>
    <label>Nome</label>
    <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{ $user->name ?? old('name') }}">
</div>
<div class="form-group">
    <label>Email</label>
    <input type="text" name="email" class="form-control" placeholder="Email" value="{{ $user->email ?? old('email') }}">
</div>
<div class="form-group">
    <label>Senha Para acessar o sistema (obrigatório):</label>
    <input type="password" name="password" class="form-control" placeholder="Senha" value="{{ $user->password ?? old('password') }}">
</div>

<input type="hidden" name="token" value="{{ $token }}">

<div class="form-group">
    <button type="submit" class="btn btn-dark">Enviar</button>
</div>
@section('js')
    @parent
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelector('input[value="sim"]').addEventListener('click', function() {
                $('#myModal').modal('show');
            });
        });
    </script>
@stop

@section('css')
    @parent
    <style>
        .custom-modal-dark .custom-modal-content {
            background-color: var(--dark);
            color: white;
        }

        .sidebar {
    display: none;
}

.content-wrapper {
    margin-left: 0;
}
    </style>
@stop
