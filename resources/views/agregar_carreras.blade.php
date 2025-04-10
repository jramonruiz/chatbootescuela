@extends('layout')

@section('contenido')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Agregar carrera</li>
  </ol>
</nav>

<br>
@if(Session::has('mensaje'))
<div class="alert alert-success">{{Session::get('mensaje')}}</div>
@endif
<br>

<form action="{{ route('guardar_carreras') }}" method="POST">
    {{ csrf_field() }}
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="source" class="form-label">Nombre de la carrera</label><br>
            <input type="text" class="form-control" name="nombre_carrera" id="nombre_carrera" value="{{ old('nombre_carrera') }}" placeholder="Nombre de la carrera" required>
        </div>
        <div class="col col-lg-1 col-md-1 col-sm-12">
            &nbsp;
            </div>
    
      <div class="col col-lg-10 col-md-10 col-sm-12">
          <input type="submit" class="btn btn-primary" id="btnguardar_carrera" name="btnguardar_carrera" value="Guardar">
        </div>
        <div class="col col-lg-1 col-md-1 col-sm-12">
        &nbsp;
        </div>
</form>
@stop