<?php
$fechahoy = date('Y-m-d'); // Formato: Año-Mes-Día
?>

@extends('layout')

@section('contenido')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Agregar nuevo alumno</li>
  </ol>
</nav>

<br>
  @if(Session::has('mensaje'))
  <div class="alert alert-success">{{Session::get('mensaje')}}</div>
  @endif
  <br>

<form action="{{ route('guardar_alumno') }}" method="POST">
    {{ csrf_field() }}
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre" value="{{ old('nombre') }}" placeholder="Nombre" required>
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
            <input type="text" class="form-control" name="apellido_paterno" id="apellido_paterno" value="{{ old('apellido_paterno') }}" placeholder="Apellido Paterno" required>
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="apellido_materno" class="form-label">Apellido Materno</label>
            <input type="text" class="form-control" name="apellido_materno" id="apellido_materno" value="{{ old('apellido_materno') }}" placeholder="Apellido Materno" required>
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
            <input type="text" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" placeholder="Fecha de nacimiento" required>
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="sexo" class="form-label">Sexo</label>
            <input type="text" class="form-control" name="sexo" id="sexo" value="{{ old('sexo') }}" placeholder="Sexo" required>
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="correo_electronico" class="form-label">Correo electronico</label>
            <input type="text" class="form-control" name="correo_electronico" id="correo_electronico" value="{{ old('correo_electronico') }}" placeholder="Correo electronico" required>
        </div>

        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="telefono" class="form-label">Telefono</label>
            <input type="text" class="form-control" name="telefono" id="telefono" value="{{ old('telefono') }}" placeholder="Telefono" required>
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="direccion" class="form-label">Direccion</label>
            <input type="text" class="form-control" name="direccion" id="direccion" value="{{ old('direccion') }}" placeholder="Direccion" required>
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="matricula" class="form-label">Matricula</label>
            <input type="text" class="form-control" name="matricula" id="matricula" value="{{ old('matricula') }}" placeholder="Matricula" required>
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="fecha_ingreso" class="form-label">Fecha ingreso</label>
            <input type="text" class="form-control" name="fecha_ingreso" id="fecha_ingreso" value="{{ old('fecha_ingreso') }}" placeholder="Fecha ingreso" required>
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="activo" class="form-label">Activo</label>
            <select class="form-control" id="estado" name="estado">
                <option value="1" {{ old('estado') == '1' ? 'selected' : '' }}>Si</option>
                <option value="0" {{ old('estado') == '0' ? 'selected' : '' }}>No</option>
            </select>    
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
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="estatus" class="form-label">Estatus</label>
            <select class="form-control" id="estatus" name="estatus" required>
                <option value="1" {{ old('estatus') == '1' ? 'selected' : '' }}>Regular</option>
                <option value="2" {{ old('estatus') == '2' ? 'selected' : '' }}>Exento</option>
            </select>    
        </div>

        <div class="col col-lg-1 col-md-1 col-sm-12">
            &nbsp;
            </div>
    
      <div class="col col-lg-10 col-md-10 col-sm-12">
          <input type="submit" class="btn btn-primary" id="btnguardar_alumno" name="btnguardar_alumno" value="Guardar">
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