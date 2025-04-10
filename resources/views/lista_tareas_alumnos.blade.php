@extends('layout')

@section('contenido')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Lista de Tareas</li>
    </ol>
  </nav>
  
  <br>
  @if(Session::has('mensaje'))
  <div class="alert alert-success">{!!Session::get('mensaje')!!}</div>
  @endif
  <br>
  
  <div class="card-body">
  <a href="{{ route('agregar_tareas_alumnos') }}"><button type="button" class="btn btn-success">Agregar tarea</button></a>&nbsp;&nbsp;&nbsp;
  <br><br>
        <table id="example2" class="table table-bordered table-striped">
          <thead>
            <tr>
                <th>Titulo</th>
                <th>Fecha de entrega</th>
                <th>Semestre</th>                
                <th>Carrera</th>
                <th>Materia</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tareas_alumnos as $tareas_alumno)
                <tr>
                    <td>{{ $tareas_alumno->titulo }}</td>
                    <td>{{ $tareas_alumno->fecha_entrega }}</td>
                    <td>{{ $tareas_alumno->semestre }}</td>
                    <td>{{ $tareas_alumno->carrera }}</td>
                    <td>{{ $tareas_alumno->nombre_materia }}</td>
                    <td>
                        <a href="{{ route('editar_tareas_alumnos',['id'=>$tareas_alumno->id]) }}"><button type="button" class="btn btn-warning">Editar</button></a>                    
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
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
@endsection
