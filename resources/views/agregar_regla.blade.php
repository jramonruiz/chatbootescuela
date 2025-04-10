@extends('layout')

@section('contenido')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Agregar regla</li>
  </ol>
</nav>

<br>
@if(Session::has('mensaje'))
<div class="alert alert-success">{{Session::get('mensaje')}}</div>
@endif
<br>

<form action="{{ route('guardar_regla') }}" method="POST">
    {{ csrf_field() }}
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="author" class="form-label">Numero de pregunta: <b>{{ $numero_pregunta_siguiente }}</b></label>
            <input type="hidden" class="form-control" name="numero_pregunta" id="numero_pregunta" value="{{ $numero_pregunta_siguiente }}">
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="id_tipo_usuario" class="form-label">Dirigido para:</label>
            <select class="form-control" id="tipo_respuesta" name="tipo_respuesta">
                <option value="4" {{ old('tipo_respuesta') == '4' ? 'selected' : '' }}>Alumno</option>
                <option value="3" {{ old('tipo_respuesta') == '3' ? 'selected' : '' }}>Docente - Administrativo</option>
            </select>    
          </div>   
          <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="id_tipo_usuario" class="form-label">Tipo respuesta:</label>
            <select class="form-control" id="url_respuestas" name="url_respuestas">
                <option value="boleta_calificaciones" {{ old('url_respuestas') == 'boleta_calificaciones' ? 'selected' : '' }}>Boleta de calificaciones</option>
                <option value="constancia_calificaciones" {{ old('url_respuestas') == 'constancia_calificaciones' ? 'selected' : '' }}>Constancia de calificaciones</option>
                <option value="kardex_calificaciones" {{ old('url_respuestas') == 'kardex_calificaciones' ? 'selected' : '' }}>Kardex de calificaciones</option>
                <option value="horario_clases" {{ old('url_respuestas') == 'horario_clases' ? 'selected' : '' }}>Horario de clases</option>
                <option value="justificante_alumno" {{ old('url_respuestas') == 'justificante_alumno' ? 'selected' : '' }}>Justificante alumno</option>
                <option value="tarea_alumno" {{ old('url_respuestas') == 'tarea_alumno' ? 'selected' : '' }}>Tarea del alumno</option>
                <option value="oficio_docente" {{ old('url_respuestas') == 'oficio_docente' ? 'selected' : '' }}>Oficio para el personal docente y administrativo</option>
              </select>    
          </div>      
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="source" class="form-label">Descripcion de la pregunta</label><br>
            <textarea id="source" name="source" style="width:895px; height:50px;" required></textarea>
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="source" class="form-label">Descripcion de la respuesta</label><br>
            <textarea id="source2" name="source2" style="width:895px; height:50px;" required></textarea>
        </div>
        <div class="col col-lg-1 col-md-1 col-sm-12">
            &nbsp;
            </div>
    
      <div class="col col-lg-10 col-md-10 col-sm-12">
          <input type="submit" class="btn btn-primary" id="btnguardar_regla" name="btnguardar_regla" value="Guardar">
        </div>
        <div class="col col-lg-1 col-md-1 col-sm-12">
        &nbsp;
        </div>
</form>
@stop