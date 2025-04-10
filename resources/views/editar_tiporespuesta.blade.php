@extends('layout')

@section('contenido')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar tipo de respuesta</li>
  </ol>
</nav>
<form action="{{ route('guardar_cambios_tiporespuesta') }}" method="POST">
    {{ csrf_field() }}
        <div class="col col-lg-10 col-md-10 col-sm-12">
          <input type="hidden" class="form-control" id="id" name="id" value="{{$tiporespuestas->id}}">
          <label for="id_tipo_usuario" class="form-label">Dirigido para:</label>
          <select class="form-control" id="id_tipo_usuario" name="id_tipo_usuario">
            <?php
            $id_tipo_usuario = $tiporespuestas->id_tipo_usuario;
            if($id_tipo_usuario==3)
                        {
                            $tipo_usuario="Docentes - Administrativos";
                        }
                        if($id_tipo_usuario==4)
                        {
                            $tipo_usuario="Alumnos";
                        }
            ?>
            <option value="{{$id_tipo_usuario}}" selected>{{$tipo_usuario}}</option>
            <option value="4" {{ old('id_tipo_usuario') == '4' ? 'selected' : '' }}>Alumno</option>
            <option value="3" {{ old('id_tipo_usuario') == '3' ? 'selected' : '' }}>Docente - Administrativo</option>
          </select>    
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
          <label for="id_tipo_usuario" class="form-label">Tipo respuesta:</label>
            <input type="text" class="form-control" name="descripcion_respuesta" id="descripcion_respuesta" placeholder="Ejemplo: Oficio para docentes y directivos" value="{{$tiporespuestas->respuesta_completa}}">
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
                <label for="title" class="form-label">Descripcion de la respuesta</label>
                <input type="text" class="form-control" name="descripcion_respuesta_chatboot" id="descripcion_respuesta_chatboot" placeholder="Ejemplo: Esta respuesta es para consultar y descargar la boleta de calificaciones" value="{{$tiporespuestas->descripcion_respuesta_chatboot}}">
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
@stop