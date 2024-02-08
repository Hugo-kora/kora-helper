@extends('adminlte::page')

@section('title', 'Categorias')
@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('categories.index') }}" class="active">Categorias</a></li>
    </ol>

    <h1>Categorias <a href="{{ route('categories.create') }}" class="btn btn-dark">Adicionar</a></h1>
@stop

@section('content')
@include('admin.includes.alerts')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('categories.search') }}" method="POST" class="form form-inline">
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
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $categorie)
                            <tr>
                                <td>{{ $categorie->name }}</td>
                                <td>
                                    <img src="{{ url("storage/{$categorie->image}") }}" alt="{{ $categorie->name }}" style="max-width: 90px;">
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('categories.show', $categorie->id) }}" class="btn btn-primary">Visualizar Categoria</a>
                                        <a href="{{ route('categories.edit', $categorie->id) }}" class="btn btn-warning">Editar Categoria</a>
                                        <a href="{{ route('categories.subcategories.index', $categorie->id) }}" class="btn btn-success">Sub-Categorias</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $categories->appends($filters)->links() !!}
            @else
                {!! $categories->links() !!}
            @endif
        </div>
    </div>
@stop
