@include('admin.includes.alerts')

@section('title', 'adastre Uma nova sub categoria')

@section('content_header')
    <h1>adastre Uma nova sub categoria</h1>
@stop
<input type="hidden" name="current_image" value="{{ $subcategory->image ?? '' }}">
    <div class="container">
        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{ $subcategory->name ?? old('name') }}">
        </div>

        <div class="form-group">
            <label>Ícone Atual:</label>
            @if($subcategory->image)
                <img src="{{ asset('storage/' . $subcategory->image) }}" alt="Ícone Atual" style="max-width: 100px; max-height: 100px;">
            @else
                <p>Nenhum ícone atual disponível</p>
            @endif
        </div>

        <label>Ícone:</label>
        <div class="form-group">
            <input type="file" name="image" class="form-control-file">
        </div>
        <div class="form-group">
            <label>Link Externo:</label>
            <input type="text" name="anchor_url" class="form-control" placeholder="Https://www.korasaude.com.br" value="{{ $subcategory->anchor_url ?? old('anchor_url') }}">
        </div>
        <div class="form-group">
            <label>Posição do (Destaque em Número):</label>
            <input type="number" name="order" class="form-control" placeholder="Ordem" value="{{ old('order') }}">
        </div>
        <div class="form-group">
            <label>Cor do ícone:</label>
            <select name="color_name" class="custom-select">
                <option value="-azul" style="background-color: #153c53; color: white;" {{ ($subcategory->color_name ?? old('color_name')) == '-azul' ? 'selected' : '' }}>Cor 1</option>
                {{-- <option value="-beje" style="background-color: #efe1d3; color: white;" {{ ($subcategory->color_name ?? old('color_name')) == '-beje' ? 'selected' : '' }}>Cor 2</option> --}}
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-dark">Enviar</button>
        </div>
</div>
