@extends('adminlte::page')

@section('title', "Detalhes da categoria {$category->name}")

@section('content_header')
    <h1>Detalhes da Categoria <b>{{ $category->name }}</b></h1>
@stop

@section('content')
@include('admin.includes.alerts')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $category->name }}
                </li>
                <li>
                    <strong>Cor do card: </strong>
                    <div style="width: 90px; height: 90px; background-color: {{ $category->color_card }};"></div>
                </li>
                <li>
                    <strong>Cor do icone: </strong>
                    <div style="width: 90px; height: 90px; background-color: {{ $category->color_icon }};"></div>
                </li>
            </ul>

            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Deletar a categoria: {{ $category->name }}</button>
            </form>
        </div>
    </div>
@endsection
