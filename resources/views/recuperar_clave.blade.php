@extends('layout')

@section('contenido')

<br>
@if(Session::has('mensaje'))
<div class="alert alert-success">{{Session::get('mensaje')}}</div>
@endif
<br>

<form action="{{ route('enviar_enlace_cambiar_clave') }}" method="POST">
    {{ csrf_field() }}
<div class="row">
      <div class="col col-lg-2 col-md-2 col-sm-12">
      &nbsp;
      </div>
      
<div class="col col-lg-8 col-md-8 col-sm-12">
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
            <p class="login-box-msg"><h3>Recuperar clave</h3></p><br><br>
                <div class="input-group mb-3">
                <b>Indicanos el correo electronico para enviar enlace de recuperacion de clave</b>
                </div>                      
                <div class="input-group mb-3">
                    <input type="text" id="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Correo eletronico para recuperar clave">
                </div>                        
                <div class="row">
                    <div class="col-8">
                    &nbsp;
                    </div>
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Generar enlace</button>
                </div>
                <!-- /.col -->
                </div>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>

    <div class="col col-lg-2 col-md-2 col-sm-12">
      &nbsp;
      </div>

</div><!-- cierre row -->
</form>

@stop