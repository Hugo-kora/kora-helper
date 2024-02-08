@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Seus dados</h1>
@stop

@section('content')
<div class="row">
    <!-- Seção para os perfis -->
    @foreach($profiles as $profile)
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua">
                    <i class="fas fa-users"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ $profile->name }}</span>
                    <span class="info-box-number">{{ $profile->users_count }}</span>
                </div>
            </div>
        </div>
    @endforeach

@endsection
