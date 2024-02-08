@extends('adminlte::page')

@section('title', 'Cadastre-se')

@section('content_header')
    <h1>Cadastre-se</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.store') }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf

                @include('admin.pages.users._partials.form')
            </form>
        </div>
    </div>
@endsection
