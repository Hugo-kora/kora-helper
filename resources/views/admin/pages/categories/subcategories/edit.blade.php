@extends('adminlte::page')

@section('title', "Editar a Sub categoria {$subcategory->name}")

@section('content_header')
    <h1>Editar a Sub categoria {{ $subcategory->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('subcategories.update', $subcategory->id) }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('admin.pages.categories.subcategories._partials.form')
            </form>
        </div>
    </div>
@endsection
