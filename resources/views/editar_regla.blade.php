<?php
$fechahoy = date('Y-m-d'); // Formato: Año-Mes-Día
?>
@extends('layout')

@section('contenido')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar Regla</li>
  </ol>
</nav>
<form action="{{ route('guardar_cambios_regla') }}" method="POST">
    {{ csrf_field() }}
    <div class="col col-lg-10 col-md-10 col-sm-12">
            <input type="hidden" class="form-control" id="id" name="id" value="{{$reglas->id}}">
            <label for="author" class="form-label">Numero de pregunta</label>
            <input type="text" class="form-control" name="numero_pregunta" id="numero_pregunta" value="{{$reglas->numero_pregunta}}" disabled>        
    </div>
    <div class="col col-lg-10 col-md-10 col-sm-12">
        <input type="hidden" class="form-control" id="id" name="id" value="{{$reglas->id}}">
        <label for="id_tipo_usuario" class="form-label">Dirigido para:</label>
        <select class="form-control" id="tipo_respuesta" name="tipo_respuesta">
          <?php
          $id_tipo_usuario = $reglas->tipo_respuesta;
          if($id_tipo_usuario=='3')
                      {
                          $tipo_usuario="Docentes - Administrativos";
                      }
                      if($id_tipo_usuario=='4')
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
        <select class="form-control" id="url_respuestas" name="url_respuestas">
          <option value="{{$reglas->url_respuestas}}" selected>{{$reglas->url_respuestas}}</option>
          @foreach ($tipo_respuestas as $tiporespuesta)
          <option value="{{ $tiporespuesta->descripcion_respuesta }}">{{ $tiporespuesta->descripcion_respuesta }}</option>
          @endforeach
          </select>    
      </div>
    <div class="col col-lg-10 col-md-10 col-sm-12">
        <label for="source" class="form-label">Descripcion de la pregunta</label><br>
        <textarea id="source" name="source" style="width:895px; height:50px;">{{$reglas->descripcion_pregunta}}</textarea>
    </div>
    <div class="col col-lg-10 col-md-10 col-sm-12">
        <label for="source" class="form-label">Descripcion de la respuesta</label><br>
        <textarea id="source2" name="source2" style="width:895px; height:50px;">{{$reglas->description_respuesta}}</textarea>
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
<script>
    /*
    $(document).ready(function() {
        $('#source').summernote({
            height: 300, // altura del editor
            toolbar: [ // personalización de la barra de herramientas
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['insert', []],
                ['view', ['codeview'],]
            ]
        });
    });

    $(document).ready(function() {
        $('#source2').summernote({
            height: 300, // altura del editor
            toolbar: [ // personalización de la barra de herramientas
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['insert', []],
                ['view', ['codeview'],]
            ]
        });
    });
    */
</script>
@stop