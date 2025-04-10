<?php
$fechahoy = date('Y-m-d'); // Formato: Año-Mes-Día
?>

@extends('layout')

@section('contenido')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Agregar nueva tarea</li>
  </ol>
</nav>

<br>
  @if(Session::has('mensaje'))
  <div class="alert alert-success">{{Session::get('mensaje')}}</div>
  @endif
  <br>

<form action="{{ route('guardar_tareas_alumnos') }}" method="POST">
    {{ csrf_field() }}
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="nombre" class="form-label">Titulo de la tarea</label>
            <input type="text" class="form-control" name="titulo" id="titulo" value="{{ old('titulo') }}" placeholder="Titulo de la tarea" required>
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="apellido_paterno" class="form-label">Descripcion</label>
            <input type="text" class="form-control" name="descripcion" id="descripcion" value="{{ old('descripcion') }}" placeholder="Descripcion de la tarea" required>
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="apellido_materno" class="form-label">Url o link de apoyo</label>
            <input type="text" class="form-control" name="archivo" id="archivo" value="{{ old('archivo') }}" placeholder="Url o link de apoyo" required>
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="fecha_nacimiento" class="form-label">Fecha de entrega</label>
            <input type="text" class="form-control" name="fecha_entrega" id="fecha_entrega" value="{{ old('fecha_entrega') }}" placeholder="Fecha de entrega" required>
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="semestre" class="form-label">Carrera</label>
            <select class="form-control" id="id_carrera" name="id_carrera" required>
                @foreach ($carreras as $carrera)
                <option value="{{ $carrera->id }}">{{ $carrera->nombre_carrera }}</option>
                @endforeach
                </select>    
        </div>
        <div class="col col-lg-10 col-md-10 col-sm-12">
            <label for="semestre" class="form-label">Semestre</label>
            <select class="form-control" id="id_semestre" name="id_semestre" required>
                @foreach ($semestres as $semestre)
                <option value="{{ $semestre->id }}">{{ $semestre->descripcion_semestre }}</option>
                @endforeach
            </select>    
            </div>

            <div class="col col-lg-10 col-md-10 col-sm-12">
              <label for="semestre" class="form-label">Materia</label>
              <select class="form-control" id="id_materia" name="id_materia" required>
              </select>    
              </div>
  

        <div class="col col-lg-1 col-md-1 col-sm-12">
            &nbsp;
            </div>
    
      <div class="col col-lg-10 col-md-10 col-sm-12">
          <input type="submit" class="btn btn-primary" id="btnguardar_tarea" name="btnguardar_tarea" value="Guardar">
        </div>
        <div class="col col-lg-1 col-md-1 col-sm-12">
        &nbsp;
        </div>
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>

<script>
    $(document).ready(function() {
      // Inicializa el datepicker
      $('#fecha_entrega').datepicker({
        format: 'yyyy-mm-dd'
      });
    });

// Obtener el token CSRF
const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;

// Función para filtrar materias cuando cambia el semestre o la carrera
function filtrarMaterias() {
    // Obtener los valores seleccionados en los combos
    const idCarrera = document.getElementById('id_carrera').value;
    const idSemestre = document.getElementById('id_semestre').value;

    // Verificar que ambos valores sean seleccionados
    if (idCarrera && idSemestre) {
        // Hacer la solicitud fetch para obtener las materias filtradas
        fetch('/filtrar_semestre_materias', {
            method: 'POST',
            body: JSON.stringify({
                id_semestre: idSemestre,
                id_carrera: idCarrera
            }),
            headers: {
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        })
        .then(response => response.json())
        .then(data => {
            // Verificar si la respuesta es exitosa
            if (data.success) {
                // Crear las opciones para el combo de materias
                let opciones = "<option value=''>Elegir</option>";
                data.lista_materias.forEach(materia => {
                    opciones += `<option value="${materia.id}">${materia.nombre_materia}</option>`;
                });
                // Insertar las opciones en el select de materias
                document.getElementById("id_materia").innerHTML = opciones;
            } else {
                // Si no hay materias, mostrar mensaje
                document.getElementById("id_materia").innerHTML = "<option value=''>No se encontraron materias</option>";
            }
        })
        .catch(error => {
            console.error('Error al filtrar las materias:', error);
        });
    } else {
        // Si no se han seleccionado carrera o semestre
        document.getElementById("id_materia").innerHTML = "<option value=''>Elegir</option>";
    }
}

// Escuchar los cambios en los combos de carrera y semestre
document.getElementById('id_carrera').addEventListener('change', filtrarMaterias);
document.getElementById('id_semestre').addEventListener('change', filtrarMaterias);    

    /* FILTRO ACTUAL
    // filtrar materias por semestre
    const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
    document.getElementById('id_semestre').addEventListener('change',(e)=>{
        fetch('filtrar_semestre_materias',{
            method : 'POST',
            body: JSON.stringify({id_semestre : e.target.value}),
            headers:{
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response =>{
            return response.json()
        }).then( data =>{
            var opciones ="<option value=''>Elegir</option>";
            for (let i in data.lista_materias) {
               opciones+= '<option value="'+data.lista_materias[i].id+'">'+data.lista_materias[i].nombre_materia+'</option>';
            }
            document.getElementById("id_materia").innerHTML = opciones;
        }).catch(error =>console.error(error));
    })

    */

    /*  ANTERIOR
    
    const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
    document.getElementById('id_semestre').addEventListener('change',(e)=>{
        fetch('materias_combo',{
            method : 'POST',
            body: JSON.stringify({texto : e.target.value}),
            headers:{
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response =>{
            return response.json()
        }).then( data =>{
            var opciones ="<option value=''>Elegir</option>";
            for (let i in data.lista) {
               opciones+= '<option value="'+data.lista[i].id+'">'+data.lista[i].nombre_materia+'</option>';
            }
            document.getElementById("id_materia").innerHTML = opciones;
        }).catch(error =>console.error(error));
    })    
*/

</script>
  
@stop