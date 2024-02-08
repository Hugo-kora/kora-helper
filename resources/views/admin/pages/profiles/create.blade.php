@extends('adminlte::page')

@section('title', 'Cadastrar Novo Perfil')

@section('content_header')
    <h1>Cadastrar Novo Perfil</h1>
@stop

@section('content')
@include('admin.includes.alerts')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('profiles.store') }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf

                @include('admin.pages.profiles._partials.form')
            </form>
        </div>
    </div>
@endsection
