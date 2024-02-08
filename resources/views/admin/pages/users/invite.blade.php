@extends('adminlte::page')


@section('title', 'Cadastrar Novo Usuário')

@section('content_header')
    <h1>Cadastrar Novo Usuário</h1>
@stop

@section('content')
@include('admin.includes.alerts')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.enviar-convite') }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
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
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
               

            </form>
        </div>
    </div>
@endsection
