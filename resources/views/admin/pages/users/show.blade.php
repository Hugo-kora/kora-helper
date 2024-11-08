@extends('adminlte::page')

@section('title', "Detalhes do usuário {$user->name}")

@section('content_header')
    <h1>Detalhes do usuário <b>{{ $user->name }}</b></h1>
@stop

@section('content')
@include('admin.includes.alerts')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $user->name }}
                </li>
                <li>
                    <strong>E-mail: </strong> {{ $user->email }}
                </li>
                @if($user->temporary_password)
                <li><strong>Senha Temporária:</strong>  {{ $user->temporary_password }}</p></li>
                @endif
                <li>
                    <strong>Dia da entrada no sistema: </strong> {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}
                </li>
            </ul>

            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Desligar {{ $user->name }}</button>
            </form>
        </div>
    </div>
@endsection
