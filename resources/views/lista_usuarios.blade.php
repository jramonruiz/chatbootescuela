@extends('layout')

@section('contenido')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Lista de usuarios</li>
    </ol>
  </nav>
  
  <br>
  @if(Session::has('mensaje'))
  <div class="alert alert-success">{{Session::get('mensaje')}}</div>
  @endif
  <br>
  
  <div class="card-body">
  <a href="{{ route('agregar_usuario') }}"><button type="button" class="btn btn-success">Agregar usuario</button></a>
        <table id="example2" class="table table-bordered table-striped">
          <thead>
            <tr>
                <th>Nombre completo</th>
                <th>Usuario</th>
                <th>Tipo</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuarios)
                <tr>
                    <td>{{ $usuarios->nombre_completo }}</td>
                    <td>{{ $usuarios->username }}</td>
                    <td>
                        <?php
                            $id_tipo_usuario=$usuarios->id_tipo_usuario;
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
                        {{ $tipo_usuario }}
                    </td>
                    <td>
                        <a href="{{ route('editar_usuario',['id'=>$usuarios->id]) }}"><button type="button" class="btn btn-warning">Editar</button></a>                    
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
