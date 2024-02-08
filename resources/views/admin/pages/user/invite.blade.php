@extends('adminlte::page')


@section('title', 'Cadastrar Novo Usuário')

@section('content_header')
    <h1>Cadastrar Novo Usuário</h1>
@stop

@section('content')
@include('admin.includes.alerts')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.enviar-convite') }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>E-mail:</label>
                    <input type="email" name="email" class="form-control" placeholder="Nome" value="{{ $user->email ?? old('email') }}">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
                <input type="hidden" name="tenant_id" value="{{ $tenant_id }}">

            </form>
        </div>
    </div>
@endsection
