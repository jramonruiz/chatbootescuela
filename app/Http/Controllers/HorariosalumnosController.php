<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horarios_alumnos;
use Illuminate\Support\Facades\DB;
use App\Models\Carreras;
use App\Models\Semestres;
use App\Models\Materias_alumnos;
use App\Models\Rangohorarios;
use Session;

class HorariosalumnosController extends Controller
{
    public function lista_horarios_alumnos()
    {
        //$alumnos = Alumnos::all();
        
        /*
        $horarioalumnos = DB::table('horarios_alumnos')
        ->join('carreras', 'horarios_alumnos.id_carrera', '=', 'carreras.id')
        ->join('semestres', 'horarios_alumnos.id_semestre', '=', 'semestres.id')
        ->select('carreras.id as id_carrera',
        'carreras.nombre_carrera as nombre_carrera',
        'semestres.id as id_semestre',
        'semestres.descripcion_semestre as descripcion_semestre',
        'horarios_alumnos.created_at as created_at')
        ->get();
        */

        $carreras = Carreras::all();

        $horarioalumnos = DB::table('horarios_alumnos')
        ->select(
            'id_carrera',
            'id_semestre',
            DB::raw('MAX(created_at) as created_at')  // Usamos MAX para obtener el valor más reciente de created_at
        )
        ->groupBy('id_carrera', 'id_semestre')  // Agrupamos por id_carrera y id_semestre
        ->get();

        
        /*
        $horarioalumnos = DB::table('horarios_alumnos as h')
        ->join('carreras as c', 'h.id_carrera', '=', 'c.carreras.id')
        ->join('semestres as s', 'h.id_semestre', '=', 's.id')
        ->select(
            'c.nombre_carrera', 
            's.descripcion_semestre', 
            'h.created_at'
        )
        ->groupBy(
            'c.nombre_carrera',
            's.descripcion_semestre'
        )
        ->get();
        */

        return view('lista_horarios_alumnos')
        //->with('contenidonoticias',$contenidonoticias);    
        ->with('horarioalumnos', $horarioalumnos)
        ->with('carreras', $carreras);  
    }

    //
    public function agregar_horarios_alumnos()
    {
        $carreras = Carreras::all();
        $semestres = Semestres::all();
        $materias_alumnos = Materias_alumnos::all();
        $rango_horarios = Rangohorarios::all();
        $total_rango_horarios = Rangohorarios::count();
        $dias_semana=['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
        return view('agregar_horarios_alumnos')
        ->with('carreras', $carreras)
        ->with('semestres', $semestres)
        ->with('materias_alumnos', $materias_alumnos)
        ->with('rango_horarios', $rango_horarios)
        ->with('dias_semana', $dias_semana)
        ->with('total_rango_horarios', $total_rango_horarios);  
    }

    public function guardar_horarios_alumnos(Request $request)
    {
        $request->validate([
            'id_carrera' => 'required',
            'id_semestre' => 'required',
            'dia_semana' => 'required',
            'id_rango_horario' => 'required',
            'id_materia' => 'required',
        ]);



        $asignacion_correcta_clase=0;

        $misma_clase_mismo_horario = Horarios_alumnos::where('id_carrera', $request->id_carrera)
        ->where('id_semestre', $request->id_semestre)
        ->where('id_materia', $request->id_materia)
        ->where('id_rango_horario', $request->id_rango_horario)
        ->where('dia_semana', $request->dia_semana)
        ->count()>0;

        $diferente_clase_mismo_horario = Horarios_alumnos::where('id_carrera', $request->id_carrera)
        ->where('id_semestre', $request->id_semestre)
        ->where('id_rango_horario', $request->id_rango_horario)
        ->where('dia_semana', $request->dia_semana)
        ->count()>0;

        if ($misma_clase_mismo_horario) 
        {
            $asignacion_correcta_clase=1;
            Session::flash('mensaje',"No se puede una clase repetida en un mismo rango de horario");
            return redirect()->back();        
        } 

        if ($diferente_clase_mismo_horario) 
        {
            $asignacion_correcta_clase=2;
            Session::flash('mensaje',"No se puede otra clase en un mismo rango de horario");
            return redirect()->back();        
        } 

        if ($asignacion_correcta_clase>0) 
        {
            Session::flash('mensaje',"No se puede asignar la clase en el horario indicado");
            return redirect()->back();        
        } 
        else 
        {
            $idcarrera=$request->id_carrera;
            $idsemestre=$request->id_semestre;

            $horario_alumno = new Horarios_alumnos;
            $horario_alumno->id_carrera=$request->id_carrera;
            $horario_alumno->id_semestre=$request->id_semestre;
            $horario_alumno->dia_semana=$request->dia_semana;
            $horario_alumno->id_rango_horario=$request->id_rango_horario;
            $horario_alumno->id_materia=$request->id_materia;
            $horario_alumno->id_usuario=1;
            $horario_alumno->save();
            Session::flash('mensaje',"Clase y horario guardado correctamente");
            return redirect()->route('agregar_horarios_alumnos_parametros',
            ['idcarrera' => $idcarrera, 'idsemestre' => $idsemestre]);
        }
    }

    public function agregar_horarios_alumnos_parametros($idcarrera,$idsemestre)
    {
        $idcarrera = $idcarrera;
        $idsemestre = $idsemestre;

        $carreras = Carreras::all();
        $semestres = Semestres::all();
        $materias_alumnos = Materias_alumnos::all();
        $rango_horarios = Rangohorarios::all();
        $dias_semana=['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];

        $registros_horarios_lunes = Horarios_alumnos::where('id_carrera', $idcarrera)
        ->where('id_semestre', $idsemestre)
        ->where('dia_semana', 'Lunes')
        ->get();

        $registros_horarios_martes = Horarios_alumnos::where('id_carrera', $idcarrera)
        ->where('id_semestre', $idsemestre)
        ->where('dia_semana', 'Martes')
        ->get();

        $registros_horarios_miercoles = Horarios_alumnos::where('id_carrera', $idcarrera)
        ->where('id_semestre', $idsemestre)
        ->where('dia_semana', 'Miercoles')
        ->get();

        $registros_horarios_jueves = Horarios_alumnos::where('id_carrera', $idcarrera)
        ->where('id_semestre', $idsemestre)
        ->where('dia_semana', 'Jueves')
        ->get();

        $registros_horarios_viernes = Horarios_alumnos::where('id_carrera', $idcarrera)
        ->where('id_semestre', $idsemestre)
        ->where('dia_semana', 'Viernes')
        ->get();

        $registros_horarios_sabado = Horarios_alumnos::where('id_carrera', $idcarrera)
        ->where('id_semestre', $idsemestre)
        ->where('dia_semana', 'Sabado')
        ->get();

        $registros_horarios_domingo = Horarios_alumnos::where('id_carrera', $idcarrera)
        ->where('id_semestre', $idsemestre)
        ->where('dia_semana', 'Domingo')
        ->get();

        return view('agregar_horarios_alumnos')
        ->with('idcarrera',$idcarrera)
        ->with('idsemestre',$idsemestre)
        ->with('carreras', $carreras)
        ->with('semestres', $semestres)
        ->with('materias_alumnos', $materias_alumnos)
        ->with('rango_horarios', $rango_horarios)
        ->with('dias_semana', $dias_semana)
        ->with('registros_horarios_lunes', $registros_horarios_lunes)
        ->with('registros_horarios_martes', $registros_horarios_martes)
        ->with('registros_horarios_miercoles', $registros_horarios_miercoles)
        ->with('registros_horarios_jueves', $registros_horarios_jueves)
        ->with('registros_horarios_viernes', $registros_horarios_viernes)
        ->with('registros_horarios_sabado', $registros_horarios_sabado)
        ->with('registros_horarios_domingo', $registros_horarios_domingo);
    }

}
