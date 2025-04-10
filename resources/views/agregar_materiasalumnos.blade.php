<?php
$fechahoy = date('Y-m-d'); // Formato: Año-Mes-Día
?>

@extends('layout')

@section('contenido')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Agregar Materia</li>
  </ol>
</nav>

<br>
  @if(Session::has('mensaje'))
  <div class="alert alert-success">{{Session::get('mensaje')}}</div>
  @endif
  <br>

<form action="{{ route('guardar_materiasalumnos') }}" method="POST">
    {{ csrf_field() }}
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="nombre" class="form-label">Clave materia</label>
            <input type="text" class="form-control" name="clave_materia" id="clave_materia" value="{{ old('clave_materia') }}" placeholder="Clave de la materia" required>
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="apellido_paterno" class="form-label">Nombre de la materia</label>
            <input type="text" class="form-control" name="nombre_materia" id="nombre_materia" value="{{ old('nombre_materia') }}" placeholder="Nombre de la materia" required>
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="apellido_materno" class="form-label">Descripcion de la materia</label>
            <input type="text" class="form-control" name="descripcion_materia" id="descripcion_materia" value="{{ old('descripcion_materia') }}" placeholder="Descripcion de la materia" required>
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="sexo" class="form-label">Creditos</label>
            <input type="text" class="form-control" name="creditos" id="creditos" value="{{ old('credito') }}" placeholder="Numero de creditos" required>
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="semestre" class="form-label">Carrera</label>
            <select class="form-control" id="carrera" name="carrera" required>
                @foreach ($carreras as $carrera)
                <option value="{{ $carrera->id }}">{{ $carrera->nombre_carrera }}</option>
                @endforeach
                </select>    
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="semestre" class="form-label">Semestre</label>
            <select class="form-control" id="semestre" name="semestre" required>
                @foreach ($semestres as $semestre)
                <option value="{{ $semestre->id }}">{{ $semestre->descripcion_semestre }}</option>
                @endforeach
            </select>    
            </div>

        <div class="col col-lg-1 col-md-1 col-sm-12">
            &nbsp;
            </div>
    
      <div class="col col-lg-10 col-md-10 col-sm-12">
          <input type="submit" class="btn btn-primary" id="btnguardar_materia" name="btnguardar_materia" value="Guardar">
        </div>
        <div class="col col-lg-1 col-md-1 col-sm-12">
        &nbsp;
        </div>
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>

<script>
    $(document).ready(function() {
      // Inicializa el datepicker
      $('#fecha_nacimiento').datepicker({
        format: 'yyyy-mm-dd'
      });
    });

    $(document).ready(function() {
      // Inicializa el datepicker
      $('#fecha_ingreso').datepicker({
        format: 'yyyy-mm-dd'
      });
    });


</script>
  
@stop