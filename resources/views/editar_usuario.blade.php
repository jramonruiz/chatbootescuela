<?php
$fechahoy = date('Y-m-d'); // Formato: Año-Mes-Día
?>
@extends('layout')

@section('contenido')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar usuario</li>
  </ol>
</nav>
<form action="{{ route('guardar_cambios_usuarios') }}" method="POST">
    {{ csrf_field() }}
    <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="nombre_completo" class="form-label">Nombre completo</label>
            <input type="hidden" class="form-control" id="id" name="id" value="{{$usuarios->id}}">
            <input type="text" class="form-control" name="nombre_completo" id="nombre_completo" value="{{$usuarios->nombre_completo}}" required>
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="username" class="form-label">Nombre de usuario</label>
            <input type="text" class="form-control" name="username" id="username" value="{{$usuarios->username}}" readonly>
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="clave" class="form-label">Clave</label>
            <input type="text" class="form-control" name="clave" id="clave" value="{{$usuarios->clave_desencriptada}}" required>
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="numero_telefono" class="form-label">Numero de telefono</label>
            <input type="text" class="form-control" name="numero_telefono" id="numero_telefono" value="{{$usuarios->numero_telefono}}" required>
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control"  id="email" name="email" value="{{$usuarios->email}}" readonly>
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="id_tipo_usuario" class="form-label">Tipo de usuario</label>
            <select class="form-control" id="id_tipo_usuario" name="id_tipo_usuario" disabled>
                <?php
                $id_tipo_usuario = $usuarios->id_tipo_usuario;
                if($id_tipo_usuario==1)
                            {
                                $tipo_usuario="Superadmin";
                            }
                            if($id_tipo_usuario==2)
                            {
                                $tipo_usuario="Adminitrador - Director";
                            }
                            if($id_tipo_usuario==3)
                            {
                                $tipo_usuario="Docente - Administrativo";
                            }
                            if($id_tipo_usuario==4)
                            {
                                $tipo_usuario="Alumno";
                            }
                ?>
                <option value="{{$id_tipo_usuario}}" selected>{{$tipo_usuario}}</option>
                <option value="1">Superadmin</option>
                <option value="2">Administrador - Director</option>
                <option value="3">Docente - Administrativo</option>
                <option value="4">Alumno</option>
            </select>    
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="activo" class="form-label">Activo</label>
            <select class="form-control" id="activo" name="activo">
                <?php
                $id_activo = $usuarios->activo;
                if($id_activo==0)
                            {
                                $activo="No";
                            }
                if($id_activo==1)
                            {
                                $activo="Si";
                            }
                ?>
                <option value="{{$id_activo}}" selected>{{$activo}}</option>
                <option value="0">No</option>
                <option value="1">Si</option>
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