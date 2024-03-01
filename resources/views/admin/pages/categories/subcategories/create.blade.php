@extends('adminlte::page')

@section('title', 'Criar Subcategoria')

@section('content_header')
@stop

@section('content')
@include('admin.includes.alerts')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('categories.subcategories.store', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="category_id" value="{{ $category->id }}">
                <div class="form-group">
                    <label class="col-sm-12 col-form-label"><h2>Dados da  sub Categoria</h2></label>
                    <br>
                    <label>Nome:</label>
                    <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label>Link Externo:</label>
                    <input type="text" name="anchor_url" class="form-control" placeholder="Https://www.korasaude.com.br" value="{{ old('anchor_url') }}">
                </div>
                <label>Ícone:</label>
                <div class="form-group">
                    <input type="file" name="image" class="form-control-file">
                </div>
                <div class="form-group">
                    <label>Cor do ícone:</label>
                    <select name="color_name" class="custom-select">
                        <option value="-azul" style="background-color: #153c53; color: white;" {{ ($category->color_name ?? old('color')) == '153c53' ? 'selected' : '' }}>Cor 1</option>
                        {{-- <option value="-beje" style="background-color: #efe1d3; color: white;" {{ ($category->color_name ?? old('color')) == 'efe1d3' ? 'selected' : '' }}>Cor 2</option> --}}
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Criar Subcategoria</button>
            </form>
        </div>
    </div>
@stop
