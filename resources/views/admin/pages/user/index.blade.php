@extends('adminlte::page')

@section('title', 'Meus Dados')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('user.index') }}" class="active">Meus dados</a></li>
    </ol>
@stop

@section('content')
@include('admin.includes.alerts')
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Nome do Personagem</th>
                        <th>Apelido do Personagem</th>
                        <th>E-mail</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->nomeInGame }}</td>
                        <td>{{ $user->surnameInGame }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-info">Editar</a>
                        </td>
                    </tr>
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
