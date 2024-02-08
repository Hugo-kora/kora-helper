@extends('adminlte::page')

@section('title', 'Subcategorias de ' . $category->name)

@section('content_header')
    <h1>Subcategorias de {{ $category->name }}</h1>
@stop

@section('content')
    @include('admin.includes.alerts')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('categories.subcategories.create', $category->id) }}" class="btn btn-primary">Criar nova sub-categoria</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Ícone</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subcategories as $subcategory)
                            <tr>
                                <td>{{ $subcategory->name }}</td>
                                <td>
                                    <img src="{{ url("storage/{$subcategory->image}") }}" alt="{{ $subcategory->name }}" style="max-width: 90px;">
                                </td>

                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('subcategories.show', $subcategory->id) }}" class="btn btn-primary">Visualizar SubCategoria</a>
                                        <a href="{{ route('subcategories.edit', $subcategory->id) }}" class="btn btn-warning">Editar SubCategoria</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {!! $subcategories->links() !!}
        </div>
    </div>
@stop
