@extends('adminlte::page')

@section('title', "Permissões disponíveis para o perfil {$profile->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('profiles.index') }}" class="active">Perfis</a></li>
    </ol>

    <h1>Permissões disponíveis para o perfil <strong>{{ $profile->name }}</strong></h1>
@stop

@section('content')
    @include('admin.includes.alerts')

    <div class="card">
        <div class="card-header">
            <form action="{{ route('profiles.permissions.available', $profile->id) }}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Filtro" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                <button type="submit" class="btn btn-dark">Filtrar</button>
            </form>
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs" id="myTabs" role="tablist">
                @foreach ($permissions as $prefix => $group)
                    <li class="nav-item">
                        <a class="nav-link" id="{{ $prefix }}-tab" data-toggle="tab" href="#{{ $prefix }}" role="tab" aria-controls="{{ $prefix }}" aria-selected="false">{{ __('messages.tabs.' . $prefix) }}</a>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content" id="myTabsContent">
                @foreach ($permissions as $prefix => $group)
                    <div class="tab-pane" id="{{ $prefix }}">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th width="50px"></th>
                                    <th>Nome</th>
                                    <th class="d-md-none"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <form action="{{ route('profiles.syncPermissions', $profile->id) }}" method="POST">
                                    @csrf
                                    @foreach ($group as $permission)
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="item-checkbox" name="permissions[]" value="{{ $permission->id }}">
                                            </td>
                                            <td>
                                                {{ $permission->description }}
                                            </td>
                                            <td class="d-md-none">
                                                <label>
                                                    <input type="checkbox" class="item-checkbox-mobile" name="permissions[]" value="{{ $permission->id }}"> Selecionar
                                                </label>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                </div>

                <div class="card-footer">
                    @include('admin.includes.alerts')
                    <button type="submit" class="btn btn-success">Vincular</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkboxes = document.querySelectorAll('.item-checkbox');
            const checkboxesMobile = document.querySelectorAll('.item-checkbox-mobile');
            const selecionarTudoBotoes = document.querySelectorAll('.selecionar-tudo-botao');
    
            selecionarTudoBotoes.forEach((botao, index) => {
                botao.addEventListener('click', function () {
                    checkboxes.forEach((checkbox, i) => {
                        if (i >= index * checkboxes.length && i < (index + 1) * checkboxes.length) {
                            checkbox.checked = true;
                        }
                    });
    
                    checkboxesMobile.forEach((checkbox, i) => {
                        if (i >= index * checkboxesMobile.length && i < (index + 1) * checkboxesMobile.length) {
                            checkbox.checked = true;
                        }
                    });
                });
            });
        });
    </script>
@stop
