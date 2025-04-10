<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\ReglasController;
use App\Http\Controllers\TiporespuestasController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\AlumnosController;
use App\Http\Controllers\MateriasalumnosController;
use App\Http\Controllers\CarrerasController;
use App\Http\Controllers\TareasalumnosController;
use App\Http\Controllers\HorariosalumnosController;
use App\Http\Controllers\RangohorariosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/chatbot', [ChatbotController::class, 'index'])->name('chatbot.index');
Route::post('/chatbot/message', [ChatbotController::class, 'handleMessage'])->name('chatbot.handle');

// rutas reglas
Route::get('/lista_reglas', [ReglasController::class, 'lista_reglas'])->name('lista_reglas');
Route::get('/agregar_regla', [ReglasController::class, 'agregar_regla'])->name('agregar_regla');
Route::post('/guardar_regla', [ReglasController::class, 'guardar_regla'])->name('guardar_regla');
Route::get('/editar_regla/{id}', [ReglasController::class, 'editar_regla'])->name('editar_regla');
Route::post('/guardar_cambios_regla', [ReglasController::class, 'guardar_cambios_regla'])->name('guardar_cambios_regla');

// rutas tipo de respuestas
Route::get('/lista_tiporespuestas', [TiporespuestasController::class, 'lista_tiporespuestas'])->name('lista_tiporespuestas');
Route::get('/agregar_tiporespuesta', [TiporespuestasController::class, 'agregar_tiporespuesta'])->name('agregar_tiporespuesta');
Route::post('/guardar_tiporespuesta', [TiporespuestasController::class, 'guardar_tiporespuesta'])->name('guardar_tiporespuesta');
Route::get('/editar_tiporespuesta/{id}', [TiporespuestasController::class, 'editar_tiporespuesta'])->name('editar_tiporespuesta');
Route::post('/guardar_cambios_tiporespuesta', [TiporespuestasController::class, 'guardar_cambios_tiporespuesta'])->name('guardar_cambios_tiporespuesta');

// rutas usuarios
Route::get('/lista_usuarios', [UsuariosController::class, 'lista_usuarios'])->name('lista_usuarios');
Route::get('/agregar_usuario', [UsuariosController::class, 'agregar_usuario'])->name('agregar_usuario');
Route::post('/guardar_usuario', [UsuariosController::class, 'guardar_usuario'])->name('guardar_usuario');
Route::get('/editar_usuario/{id}', [UsuariosController::class, 'editar_usuario'])->name('editar_usuario');
Route::post('/guardar_cambios_usuarios', [UsuariosController::class, 'guardar_cambios_usuarios'])->name('guardar_cambios_usuarios');
Route::get('/login', [UsuariosController::class, 'login'])->name('login');
Route::post('/validar', [UsuariosController::class, 'validar'])->name('validar');
Route::get('/principal', [UsuariosController::class, 'principal'])->name('principal');
Route::get('/cerrarsesion', [UsuariosController::class, 'cerrarsesion'])->name('cerrarsesion');
Route::get('/registro_empresa', [UsuariosController::class, 'registro_empresa'])->name('registro_empresa');
Route::post('/registro_datos_empresa', [UsuariosController::class, 'registro_datos_empresa'])->name('registro_datos_empresa');
Route::get('/recuperar_clave', [UsuariosController::class, 'recuperar_clave'])->name('recuperar_clave');
Route::post('/enviar_enlace_cambiar_clave', [UsuariosController::class, 'enviar_enlace_cambiar_clave'])->name('enviar_enlace_cambiar_clave');
// DEBAJO DE ESTO PARA IR EL FORMULARIO PARA RECUPERAR Y CAMBIAR LA CLAVE
//Route::post('/formulario_cambiar_clave', [UsuariosController::class, 'formulario_cambiar_clave'])->name('formulario_cambiar_clave');
Route::get('/ver_perfil/{id}', [UsuariosController::class, 'ver_perfil'])->name('ver_perfil');
Route::post('/guardar_cambios_perfil', [UsuariosController::class, 'guardar_cambios_perfil'])->name('guardar_cambios_perfil');

// rutas alumnos
Route::get('/lista_alumnos', [AlumnosController::class, 'lista_alumnos'])->name('lista_alumnos');
Route::get('/agregar_alumno', [AlumnosController::class, 'agregar_alumno'])->name('agregar_alumno');
Route::post('/guardar_alumno', [AlumnosController::class, 'guardar_alumno'])->name('guardar_alumno');
Route::get('/editar_alumno/{id}', [AlumnosController::class, 'editar_alumno'])->name('editar_alumno');
Route::post('/guardar_cambios_alumno', [AlumnosController::class, 'guardar_cambios_alumno'])->name('guardar_cambios_alumno');
Route::get('/importar_alumnos', [AlumnosController::class, 'importar_alumnos'])->name('importar_alumnos');
Route::post('/importar_excel_alumnos', [AlumnosController::class, 'importar_excel_alumnos'])->name('importar_excel_alumnos');

// rutas materias alumnos
Route::get('/lista_materiasalumnos', [MateriasalumnosController::class, 'lista_materiasalumnos'])->name('lista_materiasalumnos');
Route::get('/agregar_materiasalumnos', [MateriasalumnosController::class, 'agregar_materiasalumnos'])->name('agregar_materiasalumnos');
Route::post('/guardar_materiasalumnos', [MateriasalumnosController::class, 'guardar_materiasalumnos'])->name('guardar_materiasalumnos');
Route::get('/editar_materiasalumnos/{id}', [MateriasalumnosController::class, 'editar_materiasalumnos'])->name('editar_materiasalumnos');
Route::post('/guardar_cambios_materiasalumnos', [MateriasalumnosController::class, 'guardar_cambios_materiasalumnos'])->name('guardar_cambios_materiasalumnos');
Route::get('/importar_materiasalumnos', [MateriasalumnosController::class, 'importar_materiasalumnos'])->name('importar_materiasalumnos');
Route::post('/import_excel_materias', [MateriasalumnosController::class, 'import_excel_materias'])->name('import_excel_materias');

// rutas carreras
Route::get('/lista_carreras', [CarrerasController::class, 'lista_carreras'])->name('lista_carreras');
Route::get('/agregar_carreras', [CarrerasController::class, 'agregar_carreras'])->name('agregar_carreras');
Route::post('/guardar_carreras', [CarrerasController::class, 'guardar_carreras'])->name('guardar_carreras');
Route::get('/editar_carreras/{id}', [CarrerasController::class, 'editar_carreras'])->name('editar_carreras');
Route::post('/guardar_cambios_carreras', [CarrerasController::class, 'guardar_cambios_carreras'])->name('guardar_cambios_carreras');
Route::get('/importar_carreras', [CarrerasController::class, 'importar_carreras'])->name('importar_carreras');
Route::post('/import_excel_carreras', [CarrerasController::class, 'import_excel_carreras'])->name('import_excel_carreras');

// rutas tareas alumnos
Route::get('/lista_tareas_alumnos', [TareasalumnosController::class, 'lista_tareas_alumnos'])->name('lista_tareas_alumnos');
Route::get('/agregar_tareas_alumnos', [TareasalumnosController::class, 'agregar_tareas_alumnos'])->name('agregar_tareas_alumnos');
Route::post('/guardar_tareas_alumnos', [TareasalumnosController::class, 'guardar_tareas_alumnos'])->name('guardar_tareas_alumnos');
Route::get('/editar_tareas_alumnos/{id}', [TareasalumnosController::class, 'editar_tareas_alumnos'])->name('editar_tareas_alumnos');
Route::post('/guardar_cambios_tareas_alumnos', [TareasalumnosController::class, 'guardar_cambios_tareas_alumnos'])->name('guardar_cambios_tareas_alumnos');
Route::post('/filtrar_semestre_materias',[TareasalumnosController::class, 'filtrar_semestre_materias'])->name('filtrar_semestre_materias');

// rutas horarios alumnos
Route::get('/lista_horarios_alumnos', [HorariosalumnosController::class, 'lista_horarios_alumnos'])->name('lista_horarios_alumnos');
Route::get('/agregar_horarios_alumnos', [HorariosalumnosController::class, 'agregar_horarios_alumnos'])->name('agregar_horarios_alumnos');
Route::post('/guardar_horarios_alumnos', [HorariosalumnosController::class, 'guardar_horarios_alumnos'])->name('guardar_horarios_alumnos');
Route::get('/agregar_horarios_alumnos_parametros/{idcarrera}/{idsemestre}', [HorariosalumnosController::class, 'agregar_horarios_alumnos_parametros'])->name('agregar_horarios_alumnos_parametros');
//Route::get('/editar_tareas_alumnos/{id}', [TareasalumnosController::class, 'editar_tareas_alumnos'])->name('editar_tareas_alumnos');
//Route::post('/guardar_cambios_tareas_alumnos', [TareasalumnosController::class, 'guardar_cambios_tareas_alumnos'])->name('guardar_cambios_tareas_alumnos');
//Route::post('/filtrar_semestre_materias',[TareasalumnosController::class, 'filtrar_semestre_materias'])->name('filtrar_semestre_materias');

// rutas rango horarios
Route::get('/lista_rango_horarios', [RangohorariosController::class, 'lista_rango_horarios'])->name('lista_rango_horarios');
Route::get('/agregar_rango_horarios', [RangohorariosController::class, 'agregar_rango_horarios'])->name('agregar_rango_horarios');
Route::post('/guardar_rango_horarios', [RangohorariosController::class, 'guardar_rango_horarios'])->name('guardar_rango_horarios');
Route::get('/editar_rango_horarios/{id}', [RangohorariosController::class, 'editar_rango_horarios'])->name('editar_rango_horarios');
Route::post('/guardar_cambios_rango_horarios', [RangohorariosController::class, 'guardar_cambios_rango_horarios'])->name('guardar_cambios_rango_horarios');
