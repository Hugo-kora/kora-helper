@include('admin.includes.alerts')

@section('title', 'Cadastre-se')

@section('content_header')
    <h1>Cadastre-se</h1>
@stop

<style>
   .select:hover {
  Background: transparent;
}
</style>

<div class="container">
    <div class="form-group">
        <label class="col-sm-12 col-form-label"><h2>Dados da Categoria</h2></label>
        <br>
        <label>Nome:</label>
        <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{ $category->name ?? old('name') }}">
    </div>
    <label>Ícone:</label>
    <div class="form-group">
        <input type="file" name="image" class="form-control-file">
    </div>
    <div class="form-group">
        <label>Cor do card:</label>
        <select name="color_card" class="custom-select">
            <option value="-beje" style="background-color: #efe1d3; color: white;" {{ ($category->color_card ?? old('color')) == 'efe1d3' ? 'selected' : '' }}>Cor 1</option>
            <option value="-azul-claro" style="background-color: #a2c9e1; color: white;" {{ ($category->color_card ?? old('color')) == 'a2c9e1' ? 'selected' : '' }}>Cor 2</option>
            <option value="-azul" style="background-color: #153c53; color: white;" {{ ($category->color_card ?? old('color')) == '153c53' ? 'selected' : '' }}>Cor 3</option>
        </select>
    </div>
    <div class="form-group">
        <label>Cor do ícone:</label>
        <select name="color_name" class="custom-select">
            <option value="-azul" style="background-color: #153c53; color: white;" {{ ($category->color_name ?? old('color')) == '153c53' ? 'selected' : '' }}>Cor 1</option>
            <option value="-beje" style="background-color: #efe1d3; color: white;" {{ ($category->color_name ?? old('color')) == 'efe1d3' ? 'selected' : '' }}>Cor 2</option>
        </select>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-dark">Enviar</button>
    </div>
</div>
