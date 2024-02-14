@include('admin.includes.alerts')

@section('title', 'Cadastre um Novo usuário ao sistema')

@section('content_header')
    <h1>Cadastre um novo usuário ao sistema</h1>
@stop

@include('admin.includes.alerts')

<div class="container">
    <div class="form-group">
        <br>
        <label>Nome:</label>
        <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{ $user->name ?? old('name') }}">
    </div>

    <div class="form-group">
        <label>E-mail:</label>
        <input type="email" name="email" class="form-control" placeholder="Nome" value="{{ $user->email ?? old('email') }}">
    </div>
    <td>
        Qual perfil do usuário?<br>
        @foreach ($profiles as $profile)
            <label>
                <input type="checkbox" name="profiles_ids[]" value="{{ $profile->id }}">
                {{ $profile->name }}
            </label>
            <br>
        @endforeach
    </td>
    <div class="form-group">
        <button type="submit" class="btn btn-dark">Enviar</button>
    </div>
</div>
