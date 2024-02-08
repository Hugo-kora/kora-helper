@extends('adminlte::page')

@section('title', "Detalhes da produto {$profile->name}")

@section('content_header')
    <h1 class="d-sm-none">Detalhes da produto <b>{{ $profile->name }}</b></h1>
    <h1 class="d-none d-sm-block">Detalhes da produto <b>{{ $profile->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $profile->name }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $profile->description }}
                </li>
            </ul>
            </ul>
        </div>
    </div>
@endsection
