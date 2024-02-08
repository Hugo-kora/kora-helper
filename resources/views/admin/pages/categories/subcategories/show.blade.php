@extends('adminlte::page')

@section('title', "Detalhes da categoria {$subcategory->name}")

@section('content_header')
    <h1>Detalhes da Categoria <b>{{ $subcategory->name }}</b></h1>
@stop

@section('content')
@include('admin.includes.alerts')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $subcategory->name }}
                </li>
                <li>
                    <strong>URL Externa: </strong> {{ $subcategory->anchor_url }}
                </li>
                <li><strong>Icone<strong><br>
                <td>
                    <img src="{{ url("storage/{$subcategory->image}") }}" alt="{{ $subcategory->name }}" style="max-width: 90px;">
                </td>
            </li>
            </ul>

            <form action="{{ route('subcategories.destroy', $subcategory->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Deletar a categoria: {{ $subcategory->name }}</button>
            </form>
        </div>
    </div>
@endsection
