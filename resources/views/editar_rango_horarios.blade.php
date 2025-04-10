<?php
$fechahoy = date('Y-m-d'); // Formato: Año-Mes-Día
?>
@extends('layout')

@section('contenido')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar rango de horario</li>
  </ol>
</nav>

<br>
@if(Session::has('mensaje'))
<div class="alert alert-success">{{Session::get('mensaje')}}</div>
@endif
<br>

<form action="{{ route('guardar_cambios_rango_horarios') }}" method="POST">
    {{ csrf_field() }}
    <div class="col col-lg-10 col-md-10 col-sm-12">
            <input type="hidden" class="form-control" id="id" name="id" value="{{$rango_horarios->id}}">
            <label for="author" class="form-label">Descricion rango de horario</label>
            <input type="text" class="form-control" name="descripcion_rango_horario" id="descripcion_rango_horario" value="{{$rango_horarios->descripcion_rango_horario}}">        
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