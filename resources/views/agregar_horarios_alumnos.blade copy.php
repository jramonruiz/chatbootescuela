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

  <form action="{{ route('guardar_horarios_alumnos') }}" method="POST">
    @csrf
  <!-- Selección de Carrera, Semestre y Materia -->
        <div>
            <label for="id_carrera">Carrera</label>
            <select name="id_carrera" id="id_carrera" required>
                <option value="">Seleccionar Carrera</option>
                <!-- Aquí debes generar las opciones de carrera desde la base de datos -->
                @foreach($carreras as $carrera)
                    <option value="{{ $carrera->id }}">{{ $carrera->nombre_carrera }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="id_semestre">Semestre</label>
            <select name="id_semestre" id="id_semestre" required>
                <option value="">Seleccionar Semestre</option>
                <!-- Aquí debes generar las opciones de semestre desde la base de datos -->
                @foreach($semestres as $semestre)
                    <option value="{{ $semestre->id }}">{{ $semestre->descripcion_semestre }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="id_materia">Materia</label>
            <select name="id_materia" id="id_materia" required>
                <option value="">Seleccionar Materia</option>
                <!-- Aquí debes generar las opciones de materia desde la base de datos -->
                @foreach($materias_alumnos as $materia)
                    <option value="{{ $materia->id }}">{{ $materia->nombre_materia }}</option>
                @endforeach
            </select>
        </div>

        <!-- Tabla de Horarios -->
        <table>
            <thead>
                <tr>
                    <th>Día de la semana</th>
                    <th>Rango Horario</th>
                </tr>
            </thead>
            <tbody>
                @foreach(['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'] as $dia)
                    <tr>
                        <td>{{ $dia }}</td>
                        <td>
                            <input type="text" name="horarios[{{ $dia }}][rango_horario]" placeholder="Ejemplo. 13:10 - 14:00">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="col col-lg-10 col-md-10 col-sm-12">
            <input type="submit" class="btn btn-primary" id="btnguardar_horario_materia" name="btnguardar_horario_materia" value="Guardar">
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