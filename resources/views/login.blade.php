@extends('layout')

@section('contenido')

<br>
@if(Session::has('mensaje'))
<div class="alert alert-success">{{Session::get('mensaje')}}</div>
@endif
<br>

<form action="{{ route('validar') }}" method="POST">
            {{csrf_field()}}
<div class="row">
      <div class="col col-lg-4 col-md-4 col-sm-12">
      &nbsp;
      </div>
      
<div class="col col-lg-4 col-md-4 col-sm-12">
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
            <p class="login-box-msg">Iniciar session</p>

                <div class="input-group mb-3">
                <input type="text" id="username" name="username" class="form-control" placeholder="Usuario">
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-user"></span>
                    </div>
                </div>
                </div>
                <div class="input-group mb-3">
                <input type="password" id="clave" name="clave" class="form-control" placeholder="Clave">
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                    </div>
                </div>
                </div>
                <div class="row">
                    <div class="col-8">
                    &nbsp;
                    </div>
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Accesar</button>
                </div>
                <!-- /.col -->
                </div>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>

    <div class="col col-lg-4 col-md-4 col-sm-12">
      &nbsp;
      </div>

</div><!-- cierre row -->
</form>

@stop