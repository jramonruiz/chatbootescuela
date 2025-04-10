@extends('layout')

@section('contenido')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Lista de Horarios</li>
    </ol>
  </nav>
  
  <br>
  @if(Session::has('mensaje'))
  <div class="alert alert-success">{!!Session::get('mensaje')!!}</div>
  @endif
  <br>
  
  <div class="card-body">
  <a href="{{ route('agregar_horarios_alumnos') }}"><button type="button" class="btn btn-success">Agregar tarea</button></a>&nbsp;&nbsp;&nbsp;
  <br><br>
        <table id="example2" class="table table-bordered table-striped">
          <thead>
            <tr>
                <th>Carrera</th>
                <th>Semestre</th>                
                <th>Fecha generado</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($horarioalumnos as $horarioalumno)
                <?php
                    $idcarrera_encontrada=0;
                    $id_carrera_ciclo=$horarioalumno->id_carrera;
                    $fecha_generado_completo=$horarioalumno->created_at;
                    $fechagenerado=explode("-",$fecha_generado_completo);
                    $fecha_horario_generado=$fechagenerado[1].'-'.$fechagenerado[0];
                ?>
                <tr>
                    <td>
                        @foreach ($carreras as $carrera)
                        <?php
                            if($id_carrera_ciclo==$carrera->id)
                            {
                                $nombre_carrera=$carrera->nombre_carrera;
                            }
                        ?>
                        @endforeach
                        {{ $nombre_carrera }}
                    </td>
                    <td>{{ $horarioalumno->id_semestre }}</td>
                    <td>
                        {{ $fecha_horario_generado }}
                    </td>
                    <td>
                        <a href="{{ route('agregar_horarios_alumnos_parametros',['idcarrera'=>$horarioalumno->id_carrera,'idsemestre'=>$horarioalumno->id_semestre]) }}"><button type="button" class="btn btn-warning">Editar</button></a>                    
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
