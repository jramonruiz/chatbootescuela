<?php
$fechahoy = date('Y-m-d'); // Formato: Año-Mes-Día
?>
@extends('layout')

@section('contenido')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Agregar nuevo usuario</li>
  </ol>
</nav>

<br>
  @if(Session::has('mensaje'))
  <div class="alert alert-success">{{Session::get('mensaje')}}</div>
  @endif
  <br>

<form action="{{ route('guardar_usuario') }}" method="POST">
    {{ csrf_field() }}
    <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="nombre_completo" class="form-label">Nombre completo</label>
            <input type="text" class="form-control" name="nombre_completo" id="nombre_completo" value="{{ old('nombre_completo') }}" placeholder="Nombre completo" required>
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="username" class="form-label">Nombre de usuario</label>
            <input type="text" class="form-control" name="username" id="username" value="{{ old('username') }}" placeholder="Nombre de usuario" required>
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="clave" class="form-label">Clave</label>
            <input type="text" class="form-control" name="clave" id="clave" value="{{ old('clave') }}" placeholder="Clave" required>
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="numero_telefono" class="form-label">Numero de telefono</label>
            <input type="text" class="form-control" name="numero_telefono" id="numero_telefono" value="{{ old('numero_telefono') }}" placeholder="Numero de telefono" required>
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control"  id="email" name="email" value="{{ old('email') }}" placeholder="Correo electronico" required>
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="id_tipo_usuario" class="form-label">Tipo de usuario</label>
            <select class="form-control" id="id_tipo_usuario" name="id_tipo_usuario">
                <option value="4" {{ old('id_tipo_usuario') == '4' ? 'selected' : '' }}>Alumno</option>
                <option value="2" {{ old('id_tipo_usuario') == '2' ? 'selected' : '' }}>Administrador - Director</option>
                <option value="3" {{ old('id_tipo_usuario') == '3' ? 'selected' : '' }}>Docente - Administrativo</option>
                <option value="1" {{ old('id_tipo_usuario') == '1' ? 'selected' : '' }}>Superadmin</option>
            </select>    
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="activo" class="form-label">Activo</label>
            <select class="form-control" id="activo" name="activo">
                <option value="0" {{ old('activo') == '0' ? 'selected' : '' }}>No</option>
                <option value="1" {{ old('activo') == '1' ? 'selected' : '' }}>Si</option>
            </select>    
        </div>

        <div class="col col-lg-1 col-md-1 col-sm-12">
            &nbsp;
            </div>
    
      <div class="col col-lg-10 col-md-10 col-sm-12">
          <input type="submit" class="btn btn-primary" id="btnguardar_cuentas" name="btnguardar_cuentas" value="Guardar">
        </div>
        <div class="col col-lg-1 col-md-1 col-sm-12">
        &nbsp;
        </div>
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>
@stop