@extends('layout')

@section('contenido')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Lista de tipo de respuestas</li>
    </ol>
  </nav>
  
  <br>
  @if(Session::has('mensaje'))
  <div class="alert alert-success">{{Session::get('mensaje')}}</div>
  @endif
  <br>
  
  <div class="card-body">
  <a href="{{ route('agregar_tiporespuesta') }}"><button type="button" class="btn btn-success">Agregar tipo de respuesta</button></a>
        <table id="example2" class="table table-bordered table-striped">
          <thead>
            <tr>
                <th>ID</th>
                <th>Dirigida para</th>
                <th>Tipo respuesta</th>
                <th>Descripcion respuesta</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tiporespuestas as $tiporespuesta)
                <tr>
                    <td>{{ $tiporespuesta->id }}</td>
                    <td>
                        <?php
                           $tipo_usuario=$tiporespuesta->id_tipo_usuario;
                           if($tipo_usuario=='4')
                           {    
                            $dirigido='Alumnos';
                           } 
                           if($tipo_usuario=='3')
                           {
                            $dirigido='Docentes y administrativos';
                           } 
                        ?>
                        {{ $dirigido }}
                    </td>
                    <td>{{ $tiporespuesta->descripcion_respuesta }}</td>
                    <td>{{ $tiporespuesta->descripcion_respuesta_chatboot }}</td>
                    <td>
                        <a href="{{ route('editar_tiporespuesta',['id'=>$tiporespuesta->id]) }}"><button type="button" class="btn btn-warning">Editar</button></a>                    
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
