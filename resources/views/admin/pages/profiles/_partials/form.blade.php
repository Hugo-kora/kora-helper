@extends('layouts.app')

@include('admin.includes.alerts')

<div class="form-group">
    <label class="col-sm-2 col-form-label">* Nome:</label>
    <div class="col-sm-10">
        <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{ $profile->name ?? old('name') }}">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 col-form-label">* Descrição:</label>
    <div class="col-sm-10">
        <input type="text" name="description" class="form-control" placeholder="Descrição:" value="{{ $profile->description ?? old('Descrição') }}">
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-dark">Enviar</button>
    </div>
</div>
