@extends('layout')

@section('contenido')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Agregar rango de horario</li>
  </ol>
</nav>

<br>
@if(Session::has('mensaje'))
<div class="alert alert-success">{{Session::get('mensaje')}}</div>
@endif
<br>

<form action="{{ route('guardar_rango_horarios') }}" method="POST">
    {{ csrf_field() }}
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="source" class="form-label">Rango de horario</label><br>
            <input type="text" class="form-control" name="descripcion_rango_horario" id="descripcion_rango_horario" value="{{ old('descripcion_rango_horario') }}" placeholder="13:10 - 14:00" required>
        </div>
        <div class="col col-lg-1 col-md-1 col-sm-12">
            &nbsp;
            </div>
    
      <div class="col col-lg-10 col-md-10 col-sm-12">
          <input type="submit" class="btn btn-primary" id="btnguardar_rango_horario" name="btnguardar_rango_horario" value="Guardar">
        </div>
        <div class="col col-lg-1 col-md-1 col-sm-12">
        &nbsp;
        </div>
</form>
@stop