@extends('adminlte::page')


@section('title', 'Cadastrar Novo Usuário')

@section('content_header')
    <h1>Cadastrar Novo Usuário</h1>
@stop

@section('content')
@include('admin.includes.alerts')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('user.store') }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf

                @include('admin.pages.user._partials.form')
            </form>
        </div>
    </div>
@endsection
