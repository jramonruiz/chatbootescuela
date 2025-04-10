@extends('layout')

@section('contenido')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Importar Alumnos</li>
    </ol>
  </nav>

  @if (session('success'))
  <div class="alert alert-success">
      {{ session('success') }}
  </div>
@endif

@if (session('error'))
  <div class="alert alert-danger">
      {{ session('error') }}
  </div>
@endif

<form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
    @csrf
  <input type="file" name="file">
  <button type="submit">Importar</button>
</form>
  
  <br>
@endsection
