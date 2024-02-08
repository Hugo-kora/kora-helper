@extends('adminlte::page')

@section('title', "Usuários disponíveis")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('profiles.index') }}" class="active">Perfis</a></li>
    </ol>

    @section('title', 'Usuários disponíveis perfil ' . $user->name)

@stop

@section('content')
@include('admin.includes.alerts')
<div class="card">
    <div class="card-header">
        <form action="{{ route('profiles.permissions.available', $user->id) }}" method="POST" class="form form-inline">
            @csrf
            <input type="text" name="filter" placeholder="Filtro" class="form-control" value="{{ $filters['filter'] ?? '' }}">
            <button type="submit" class="btn btn-dark">Filtrar</button>
        </form>
    </div>
    <div class="card-body">
        <label>
            <input type="checkbox" class="btn btn-primary" id="selecionar-tudo-botao"> Selecionar Tudo
        </label>
        <table class="table table-condensed">
                <thead>
                    <tr>
                        <th width="50px">#</th>
                        <th>Nome</th>
                        <th class="d-md-none"></th>
                    </tr>
                </thead>
                <tbody>
                    <form action="{{ route('users.syncProfiles', $user->id) }}" method="POST">
                        @csrf
                        @foreach ($profiles as $profile)
                            <tr>
                                <td>
                                    <input type="checkbox" class="item-checkbox" name="profiles[]" value="{{ $profile->id }}">
                                </td>
                                <td>
                                    {{ $profile->description }}
                                </td>
                                <td class="d-md-none">
                                    <label>
                                        <input type="checkbox" class="item-checkbox-mobile" name="profiles[]" value="{{ $profile->id }}"> Selecionar
                                    </label>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="500">
                                @include('admin.includes.alerts')

                                <button type="submit" class="btn btn-success">Vincular</button>
                            </td>
                        </tr>
                    </form>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkboxSelecionarTudo = document.getElementById('selecionar-tudo-botao');
            const checkboxes = document.querySelectorAll('.item-checkbox');
            const checkboxesMobile = document.querySelectorAll('.item-checkbox-mobile');

            checkboxSelecionarTudo.addEventListener('change', function () {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = checkboxSelecionarTudo.checked;
                });
            });

            checkboxesMobile.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    checkboxSelecionarTudo.checked = checkboxesMobile.every(checkbox => checkbox.checked);
                });
            });
        });
    </script>
@stop
