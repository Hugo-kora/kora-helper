@extends('adminlte::page')

@section('title', 'Cadastre-se na Kora Helper')

@section('content_header')
    <h1>Cadastre-se na Kora Helper</h1>
@stop

@section('content')
    @include('admin.includes.alerts')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('invite.accept', $token) }}" enctype="multipart/form-data">
                @csrf

                @include('admin.pages.invite._partials.form')
            </form>
        </div>
    </div>
@endsection
