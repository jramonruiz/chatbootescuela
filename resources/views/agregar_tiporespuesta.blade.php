@extends('layout')

@section('contenido')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Agregar tipo de respuesta</li>
  </ol>
</nav>

<br>
@if(Session::has('mensaje'))
<div class="alert alert-success">{{Session::get('mensaje')}}</div>
@endif
<br>


<form action="{{ route('guardar_tiporespuesta') }}" method="POST">
    {{ csrf_field() }}
    <div class="col col-lg-10 col-md-10 col-sm-12">
      <label for="id_tipo_usuario" class="form-label">Dirigido para:</label>
      <select class="form-control" id="id_tipo_usuario" name="id_tipo_usuario">
          <option value="4" {{ old('id_tipo_usuario') == '4' ? 'selected' : '' }}>Alumno</option>
          <option value="3" {{ old('id_tipo_usuario') == '3' ? 'selected' : '' }}>Docente - Administrativo</option>
      </select>    
    </div>
    <div class="col col-lg-10 col-md-10 col-sm-12">
      <label for="id_tipo_usuario" class="form-label">Tipo respuesta:</label>
      <input type="text" class="form-control" name="descripcion_respuesta" id="descripcion_respuesta" placeholder="Ejemplo: Oficio para docentes y directivos">
      </div>
    <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="title" class="form-label">Descripcion de la respuesta</label>
            <input type="text" class="form-control" name="descripcion_respuesta_chatboot" id="descripcion_respuesta_chatboot" placeholder="Ejemplo: Esta respuesta es para consultar y descargar la boleta de calificaciones">
        </div>
    <div class="col col-lg-10 col-md-10 col-sm-12">
          <input type="submit" class="btn btn-primary" id="btnguardar_cuentas" name="btnguardar_cuentas" value="Guardar">
        </div>
        <div class="col col-lg-1 col-md-1 col-sm-12">
        &nbsp;
    </div>
</form>
@stop