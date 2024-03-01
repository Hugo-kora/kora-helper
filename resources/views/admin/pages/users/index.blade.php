@extends('adminlte::page')

@section('title', 'Usuários')
@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('users.index') }}" class="active">Usuários</a></li>
    </ol>

    <h1>Usuários <a href="{{ route('users.create') }}" class="btn btn-dark">Adicionar</a></h1>
@stop

@section('content')
@include('admin.includes.alerts')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('users.search') }}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Filtrar:" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                <button type="submit" class="btn btn-dark">Filtrar</button>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-warning">Visualizar Usuário</a>
                                        <a href="{{ route('users.profiles', $user->id) }}" class="btn btn-success">Perfil</a>
                                        <a href="{{ route('user.passwordTemporary.update', $user) }}" class="btn btn-primary">Redefinir Senha temporária</a>
                                    </div>
                                </td>
                            </tr>
                            <form id="reset-password-form-{{ $user->id }}" action="{{ route('user.password.update', $user) }}" method="POST" style="display: none;">
                                @csrf
                                @method('PUT')
                            </form>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $users->appends($filters)->links() !!}
            @else
                {!! $users->links() !!}
            @endif
        </div>
    </div>
@stop
