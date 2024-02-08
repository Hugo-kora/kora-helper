@extends('adminlte::page')

@section('title', 'Cadastre uma nova categoria')

@section('content_header')
    <h1>Cadastre uma nova categoria</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('categories.store') }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf

                @include('admin.pages.categories._partials.form')
            </form>
        </div>
    </div>
@endsection
