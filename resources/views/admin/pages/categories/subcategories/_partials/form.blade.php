@include('admin.includes.alerts')

@section('title', 'Cadastre-se')

@section('content_header')
    <h1>Cadastre-se</h1>
@stop

    <div class="container">
        <div class="form-group">
            <label class="col-sm-12 col-form-label"><h2>Dados da Categoria</h2></label>
            <br>
            <label>Nome:</label>
            <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{ $subcategory->name ?? old('name') }}">
        </div>
        <div class="form-group">
            <label>Link Externo:</label>
            <input type="text" name="anchor_url" class="form-control" placeholder="Https://www.korasaude.com.br" value="{{ $subcategory->anchor_url ?? old('anchor_url') }}">
        </div>
        <label>Ícone:</label>
        <div class="form-group">
            <input type="file" name="image" class="form-control-file">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-dark">Enviar</button>
        </div>
</div>
