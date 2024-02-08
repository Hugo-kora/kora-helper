@extends('adminlte::page')

@section('title', "Perfil do usuário {$user->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('users.index') }}" class="active">Usuários</a></li>
    </ol>

    <h1>Perfil do Usuário <strong>{{ $user->name }}</strong></h1>
    <a href="{{ route('users.profiles.available', $user->id) }}" class="btn btn-dark">Adicionar Novo Perfil</a>
@stop

@section('content')
    @include('admin.includes.alerts')
    <div class="card">
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th width="50">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($profiles as $profile)
                        <tr>
                            <td class="d-md-none" style="width=10px;">
                                <td>{{ $profile->description }}
                            <td><a href="{{ route('users.profile.detach', [$profile->id, $user->id]) }}" class="btn btn-danger">DESVINCULAR</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $profiles->appends($filters)->links() !!}
            @else
                {!! $profiles->links() !!}
            @endif
    </div>
</div>
@stop
