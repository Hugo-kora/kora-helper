@extends('adminlte::page')

@section('title', "Permissões do perfil {$profile->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('profiles.index') }}" class="active">Perfis</a></li>
    </ol>

    <h1>Permissões do perfil <strong>{{ $profile->name }}</strong></h1>

    <a href="{{ route('profiles.permissions.available', $profile->id) }}" class="btn btn-dark d-md-none">Adicionar NOVA PERMISSÃO</a>
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
                    @foreach ($permissions as $permission)
                        <tr>
                            <td class="d-md-none" style="width=10px;">
                                <td>{{ $permission->description }}
                            <td><a href="{{ route('profiles.permission.detach', [$profile->id, $permission->id]) }}" class="btn btn-danger">DESVINCULAR</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $permissions->appends($filters)->links() !!}
            @else
                {!! $permissions->links() !!}
            @endif
        <a href="{{ route('profiles.permissions.available', $profile->id) }}" class="btn btn-dark d-none d-md-inline-block">Adicionar NOVA PERMISSÃO</a>
    </div>
</div>
@stop
