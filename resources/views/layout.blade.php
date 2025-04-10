<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Asistente Educativo - Chatboot</title>

  <!-- Agregar el archivo CSS de AdminLTE -->
  <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
      
  <!-- Agregar otros archivos CSS si es necesario, como los de FontAwesome, etc. -->
  <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/fontawesome-free/css/all.min.css') }}">  

  <!-- Incluir Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Incluir jQuery y Popper.js (necesarios para los dropdowns en Bootstrap) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>

  <!-- Incluir Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Incluir Bootstrap Datepicker CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">

<style>
/* Asegúrate de que la imagen del logotipo sea responsiva */
.logo {
    max-width: 25%;    /* La imagen puede ocupar hasta el 250% del ancho disponible */
    height: 25%;       /* Mantiene la relación de aspecto */
    display: block;     /* Hace que la imagen sea un bloque (para evitar que esté en línea con otros elementos) */
    margin: 0 auto;     /* Centra la imagen */
}


</style>

</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid"> <!-- Usamos 'container-fluid' para el ancho completo -->
    
    <!-- Logotipo alineado a la izquierda -->
    <a class="navbar-brand" href="#">
      <img src="{{ asset('images/logo_ave.jpg') }}" alt="Logo ave" class="logo" style="max-width: 10%; height: 10%;">
    </a>

    <!-- Botón para móvil (toggle navbar) -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menú -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto"> <!-- 'ml-auto' empuja el menú a la izquierda -->
        <!-- Opción de menú con submenú -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Administracion
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('lista_alumnos') }}">Alumnos</a>
            <a class="dropdown-item" href="{{ route('lista_materiasalumnos') }}">Materias</a>
            <a class="dropdown-item" href="{{ route('lista_carreras') }}">Carreras</a>
            <a class="dropdown-item" href="{{ route('lista_tareas_alumnos') }}">Tareas</a>
            <a class="dropdown-item" href="{{ route('lista_rango_horarios') }}">Rango de horarios</a>
            <a class="dropdown-item" href="{{ route('lista_horarios_alumnos') }}">Horarios</a>
          </div>
        </li>

        <!-- Opción de menú con submenú -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Preguntas y respuestas chatboot
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
            <a class="dropdown-item" href="{{ route('lista_reglas') }}">Reglas</a>
            <a class="dropdown-item" href="{{ route('lista_tiporespuestas') }}">Tipo de respuestas</a>
          </div>
        </li>

        <!-- Opción de menú normal -->
        <li class="nav-item">
          <a class="nav-link" href="{{ route('lista_usuarios') }}">Usuarios</a>
        </li>

        <!-- Opción de menú normal -->
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="{{ route('cerrarsesion') }}">Cerrar sesión</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


<!-- Contenido de la página -->
<!-- Incluir Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <div id="contenido" class="container-fluid">
        @yield('contenido')
    </div>


<!-- Incluir Bootstrap Datepicker JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>

</body>
</html>