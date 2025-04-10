<?php
$fechahoy = date('Y-m-d'); // Formato: Año-Mes-Día
?>
@extends('layout')

@section('contenido')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Ver perfil</li>
  </ol>
</nav>

<br>
@if(Session::has('mensaje'))
<div class="alert alert-success">{{Session::get('mensaje')}}</div>
@endif
<br>

<form action="{{ route('guardar_cambios_perfil') }}" method="POST">
    {{ csrf_field() }}
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="nombre_completo" class="form-label">Nombre completo</label>
            <input type="hidden" class="form-control" id="id" name="id" value="{{$usuarios->id}}">
            <input type="hidden" class="form-control" id="id_tipo_usuario" name="id_tipo_usuario" value="{{$usuarios->id_tipo_usuario}}">
            <input type="text" class="form-control" name="nombre_completo" id="nombre_completo" value="{{$usuarios->nombre_completo}}" disabled>
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="numero_telefono" class="form-label">Numero de telefono</label>
            <input type="text" class="form-control" name="numero_telefono" id="numero_telefono" value="{{$usuarios->numero_telefono}}" required>
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control"  id="email" name="email" value="{{$usuarios->email}}" required>
        </div>
        <?php
            $id_tipo_usuario=$usuarios->id_tipo_usuario;
            if($id_tipo_usuario==3)
            {
        ?>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="numero_telefono" class="form-label">Direccion</label>
            <input type="text" class="form-control" name="direccion" id="direccion" value="{{$usuarios->direccion}}">
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="email" class="form-label">Codigo postal</label>
            <input type="text" class="form-control"  id="codigo_postal" name="codigo_postal" value="{{$usuarios->codigo_postal}}">
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="numero_telefono" class="form-label">Estado</label>
            <input type="text" class="form-control" name="estado" id="estado" value="{{$usuarios->estado}}">
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="email" class="form-label">Ciudad</label>
            <input type="text" class="form-control"  id="ciudad" name="ciudad" value="{{$usuarios->ciudad}}">
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="email" class="form-label">Nombre empresa</label>
            <input type="text" class="form-control"  id="nombre_compania" name="nombre_compania" value="{{$usuarios->nombre_compania}}" required>
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="email" class="form-label">Url empresa</label>
            <input type="text" class="form-control"  id="url_compania" value="{{$usuarios->url_compania}}" name="url_compania" required>
        </div>
        <?php
            }
        ?>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="username" class="form-label">Nombre de usuario</label>
            <input type="text" class="form-control" name="username" id="username" value="{{$usuarios->username}}" disabled>
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="clave" class="form-label">Clave</label>
            <input type="text" class="form-control" name="clave" id="clave" value="{{$usuarios->clave_desencriptada}}" required>
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