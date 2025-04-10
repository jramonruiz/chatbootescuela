@extends('layout')

@section('contenido')

<br>
@if(Session::has('mensaje'))
<div class="alert alert-success">{{Session::get('mensaje')}}</div>
@endif
<br>

<form action="{{ route('registro_datos_empresa') }}" method="POST">
    {{ csrf_field() }}
<div class="row">
      <div class="col col-lg-2 col-md-2 col-sm-12">
      &nbsp;
      </div>
      
<div class="col col-lg-8 col-md-8 col-sm-12">
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
            <p class="login-box-msg"><h3>Registro de empresas</h3></p><br><br>
                <div class="input-group mb-3">
                <b>Nombre completo</b>
                </div>
                <div class="input-group mb-3">
                <input type="text" id="nombre_completo" name="nombre_completo" class="form-control" value="{{ old('nombre_completo') }}" placeholder="Nombre completo">
                </div>
                <div class="input-group mb-3">
                <b>Telefono</b>
                </div>    
                <div class="input-group mb-3">
                    <input type="text" id="numero_telefono" name="numero_telefono" class="form-control" value="{{ old('numero_telefono') }}" placeholder="Telefono">
                </div>
                <div class="input-group mb-3">
                <b>Correo electronico</b>
                </div>                      
                <div class="input-group mb-3">
                    <input type="text" id="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Correo eletronico">
                </div>                        
                <div class="input-group mb-3">
                    <b>Direccion</b>
                </div>                      
                <div class="input-group mb-3">
                    <input type="text" id="direccion" name="direccion" class="form-control" value="{{ old('direccion') }}" placeholder="Direccion">
                </div>                        
                <div class="input-group mb-3">
                    <b>Codigo postal</b>
                </div>                      
                <div class="input-group mb-3">
                    <input type="text" id="codigo_postal" name="codigo_postal" class="form-control" value="{{ old('codigo_postal') }}" placeholder="Codigo postal">
                </div>                                    
                <div class="input-group mb-3">
                    <b>Estado</b>
                </div>                      
                <div class="input-group mb-3">
                    <input type="text" id="estado" name="estado" class="form-control" value="{{ old('estado') }}" placeholder="Estado">
                </div>                                    
                <div class="input-group mb-3">
                    <b>Ciudad</b>
                </div>                      
                <div class="input-group mb-3">
                    <input type="text" id="ciudad" name="ciudad" class="form-control" value="{{ old('ciudad') }}" placeholder="Ciudad">
                </div>                                    
                <div class="input-group mb-3">
                    <b>Nombre de la empresa</b>
                </div>                      
                <div class="input-group mb-3">
                    <input type="text" id="nombre_compania" name="nombre_compania" class="form-control" value="{{ old('nombre_compania') }}" placeholder="Nombre de la empresa">
                </div>                                    
                <div class="input-group mb-3">
                    <b>Url de la empresa</b>
                </div>                      
                <div class="input-group mb-3">
                    <input type="text" id="url_compania" name="url_compania" class="form-control" value="{{ old('url_compania') }}" placeholder="Url de la empresa">
                </div>                                    
                <div class="input-group mb-3">
                <b>Nombre usuario</b>
                </div>                          
                <div class="input-group mb-3">
                <input type="text" id="username" name="username" class="form-control" value="{{ old('username') }}" placeholder="Usuario">
                </div>
                <div class="input-group mb-3">
                <b>Clave</b>
                </div>                          
                <div class="input-group mb-3">
                <input type="text" id="clave" name="clave" class="form-control" value="{{ old('clave') }}" placeholder="Clave">
                </div>
                <div class="input-group mb-3">
                <b>Repetir clave</b>
                </div>                              
                <div class="input-group mb-3">
                    <input type="text" id="clave_repetir" name="clave_repetir" class="form-control" value="{{ old('clave_repetir') }}" placeholder="Repite tu clave">
                </div>    
                <div class="row">
                    <div class="col-8">
                    &nbsp;
                    </div>
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Registrate</button>
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