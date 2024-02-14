@extends('adminlte::page')

@section('title', 'Alterar Senha')

@section('content_header')
    <h1>Alterar Senha</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('user.password.update', $user->id) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Senha:</label>
                    <input type="password" name="password" class="form-control" placeholder="Senha">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-dark">Enviar</button>
                </div>
            </form>
        </div>
    </div>
@stop
