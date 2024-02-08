@extends('adminlte::page')

@section('title', "Editar o Perfil {$profile->name}")

@section('content_header')
    <h1>Editar a empresa {{ $profile->name }}</h1>
@stop

@section('content')
@include('admin.includes.alerts')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('profiles.update', $profile->id) }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('admin.pages.profiles._partials.form')
            </form>
        </div>
    </div>
@endsection
