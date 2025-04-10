<?php
$fechahoy = date('Y-m-d'); // Formato: Año-Mes-Día
?>

@extends('layout')

@section('contenido')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Asignar materia y horario</li>
  </ol>
</nav>

<br>
  @if(Session::has('mensaje'))
  <div class="alert alert-success">{{Session::get('mensaje')}}</div>
  @endif
  <br>

  <form action="{{ route('guardar_horarios_alumnos') }}" method="POST">
    @csrf
  <!-- Selección de Carrera, Semestre y Materia -->
  <div class="row">
        <div class="col col-lg-4 col-md-4 col-sm-12">            
            <label for="id_carrera">Carrera</label>
                <select name="id_carrera" id="id_carrera" required>
                    <option value="">Seleccionar Carrera</option>
                    <!-- Aquí debes generar las opciones de carrera desde la base de datos -->
                    @foreach($carreras as $carrera)
                        <option value="{{ $carrera->id }}">{{ $carrera->nombre_carrera }}</option>
                    @endforeach
                </select>
        </div>

        <div class="col col-lg-4 col-md-4 col-sm-12">            
            <label for="id_semestre">Semestre</label>
                <select name="id_semestre" id="id_semestre" required>
                    <option value="">Seleccionar Semestre</option>
                    <!-- Aquí debes generar las opciones de semestre desde la base de datos -->
                    @foreach($semestres as $semestre)
                        <option value="{{ $semestre->id }}">{{ $semestre->descripcion_semestre }}</option>
                    @endforeach
                </select>
        </div>

        <div class="col col-lg-4 col-md-4 col-sm-12">            
            <label for="dia_semana">Dia semana</label>
                <select name="dia_semana" id="dia_semana" required>
                    <option value="">Seleccionar dia de la semana</option>
                    <!-- Aquí debes generar las opciones de semestre desde la base de datos -->
                    @foreach($dias_semana as $dia_semana)
                        <option value="{{ $dia_semana }}">{{ $dia_semana }}</option>
                    @endforeach
                </select>
        </div>
    </div>    

    <div class="row">
        <div class="col col-lg-4 col-md-4 col-sm-12">            
            <label for="id_rango_horario">Rango de horario</label>
                <select name="id_rango_horario" id="id_rango_horario" required>
                    <option value="">Seleccione el rango de horario</option>
                    <!-- Aquí debes generar las opciones de semestre desde la base de datos -->
                    @foreach($rango_horarios as $rango_horario)
                        <option value="{{ $rango_horario->descripcion_rango_horario }}">{{ $rango_horario->descripcion_rango_horario }}</option>
                    @endforeach
                </select>
        </div>

        <div class="col col-lg-4 col-md-4 col-sm-12">            
            <label for="id_materia">Materia</label>
                <select name="id_materia" id="id_materia" required>
                    <option value="">Seleccione la materia</option>
                    <!-- Aquí debes generar las opciones de semestre desde la base de datos -->
                    @foreach($materias_alumnos as $materias_alumno)
                        <option value="{{ $materias_alumno->nombre_materia }}">{{ $materias_alumno->nombre_materia }}</option>
                    @endforeach
                </select>
        </div>

        <div class="col col-lg-4 col-md-4 col-sm-12">            
            <button class="btn btn-success" type="submit">Guardar Materia para el horario</button>
            <a href="{{ route('lista_horarios_alumnos') }}"><button type="button" class="btn btn-warning">Lista de horarios</button></a>
        </div>
    </div>

    <br>

    @if(!empty($idcarrera) || !empty($idsemestre))
        <!-- Tabla de Horarios -->

    <table id="example1" class="table table-bordered table-striped">
    <tr>
        <th>Horario</th>
        @foreach(['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'] as $dia)
            <th>{{ $dia }}</th>
        @endforeach
    </tr>
    @foreach($rango_horarios as $rango_horario)
    <tr>
        <td>
            <!-- Columna Rango de horario -->
            <?php
                $rangohorario=$rango_horario->descripcion_rango_horario;
            ?>
            {{ $rango_horario->descripcion_rango_horario }} <br>
        </td>
        <td>
            <!-- Columna Materias Lunes --> 
            @foreach($registros_horarios_lunes as $registros_horario_lunes)
            <?php
                $horariolunes=$registros_horario_lunes->id_rango_horario;
                if (strtolower($rangohorario) == strtolower($horariolunes)) 
                {
            ?>
            {{ $registros_horario_lunes->id_materia }}
            <?php
                }
            ?>
            @endforeach
        </td>
        <td>
            <!-- Columna Materias Martes --> 
            @foreach($registros_horarios_martes as $registros_horario_martes)
            <?php
                $horariomartes=$registros_horario_martes->id_rango_horario;
                if (strtolower($rangohorario) == strtolower($horariomartes)) 
                {
            ?>
            {{ $registros_horario_martes->id_materia }}
            <?php
                }
            ?>
            @endforeach
        </td>
        <td>
            <!-- Columna Materias Miercoles --> 
            @foreach($registros_horarios_miercoles as $registros_horario_miercoles)
            <?php
                $horariomiercoles=$registros_horario_miercoles->id_rango_horario;
                if (strtolower($rangohorario) == strtolower($horariomiercoles)) 
                {
            ?>
            {{ $registros_horario_miercoles->id_materia }}
            <?php
                }
            ?>
            @endforeach
        </td>
        <td>
            <!-- Columna Materias Jueves --> 
            @foreach($registros_horarios_jueves as $registros_horario_jueves)
            <?php
                $horariojueves=$registros_horario_jueves->id_rango_horario;
                if (strtolower($rangohorario) == strtolower($horariojueves)) 
                {
            ?>
            {{ $registros_horario_jueves->id_materia }}
            <?php
                }
            ?>
            @endforeach
        </td>
        <td>
            <!-- Columna Materias Viernes --> 
            @foreach($registros_horarios_viernes as $registros_horario_viernes)
            <?php
                $horarioviernes=$registros_horario_viernes->id_rango_horario;
                if (strtolower($rangohorario) == strtolower($horarioviernes)) 
                {
            ?>
            {{ $registros_horario_viernes->id_materia }}
            <?php
                }
            ?>
            @endforeach
        </td>
        <td>
            <!-- Columna Materias Sabado --> 
            @foreach($registros_horarios_sabado as $registros_horario_sabado)
            <?php
                $horariosabado=$registros_horario_sabado->id_rango_horario;
                if (strtolower($rangohorario) == strtolower($horariosabado)) 
                {
            ?>
            {{ $registros_horario_sabado->id_materia }}
            <?php
                }
            ?>
            @endforeach
        </td>
        <td>
            <!-- Columna Materias Domingo --> 
            @foreach($registros_horarios_domingo as $registros_horario_domingo)
            <?php
                $horariodomingo=$registros_horario_domingo->id_rango_horario;
                if (strtolower($rangohorario) == strtolower($horariodomingo)) 
                {
            ?>
            {{ $registros_horario_domingo->id_materia }}
            <?php
                }
            ?>
            @endforeach
        </td>
    </tr>
    @endforeach    
    </table>

    @endif


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

<!-- /.card-body -->
<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- Page specific script -->
<script>
$(function () {
$("#example1").DataTable({
"responsive": true, "lengthChange": false, "autoWidth": false,
"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
$('#example2').DataTable({
"paging": true,
"lengthChange": false,
"searching": true,
"ordering": true,
"info": true,
"autoWidth": false,
"responsive": true,
});
});
</script>

  
@stop