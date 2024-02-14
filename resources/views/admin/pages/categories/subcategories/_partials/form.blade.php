@include('admin.includes.alerts')

@section('title', 'adastre Uma nova sub categoria')

@section('content_header')
    <h1>adastre Uma nova sub categoria</h1>
@stop

    <div class="container">
        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{ $subcategory->name ?? old('name') }}">
        </div>
        <label>Ícone:</label>
        <div class="form-group">
            <input type="file" name="image" class="form-control-file">
        </div>
        <div class="form-group">
            <label>Link Externo:</label>
            <input type="text" name="anchor_url" class="form-control" placeholder="Https://www.korasaude.com.br" value="{{ old('anchor_url') }}">
        </div>
        <div class="form-group">
            <label>Cor do card:</label>
            <select name="color_card" class="custom-select">
                <option value="-beje" style="background-color: #efe1d3; color: white;" value="{{ $subcategory->color_card ?? old('color_card') }}" {{ ($category->color_card ?? old('color')) == 'efe1d3' ? 'selected' : '' }}>Cor 1</option>
                <option value="-azul-claro" style="background-color: #a2c9e1; color: white;" value="{{ $subcategory->color_card ?? old('color_card') }}" {{ ($category->color_card ?? old('color')) == 'a2c9e1' ? 'selected' : '' }}>Cor 2</option>
                <option value="-azul" style="background-color: #153c53; color: white;" value="{{ $subcategory->color_card ?? old('color_card') }}" {{ ($category->color_card ?? old('color')) == '153c53' ? 'selected' : '' }}>Cor 3</option>
            </select>
        </div>
        <div class="form-group">
            <label>Cor do ícone:</label>
            <select name="color_name" class="custom-select">
                <option value="-azul" style="background-color: #153c53; color: white;"value="{{ $subcategory->color_name ?? old('color_name') }}" {{ ($category->color_name ?? old('color')) == '153c53' ? 'selected' : '' }}>Cor 1</option>
                <option value="-beje" style="background-color: #efe1d3; color: white;" value="{{ $subcategory->color_name ?? old('color_name') }}" {{ ($category->color_name ?? old('color')) == 'efe1d3' ? 'selected' : '' }}>Cor 2</option>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-dark">Enviar</button>
        </div>
</div>
