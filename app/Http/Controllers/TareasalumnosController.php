<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tareas_alumnos;
use App\Models\Carreras;
use App\Models\Semestres;
use App\Models\Materias_alumnos;
use Session;

class TareasalumnosController extends Controller
{
    //
    public function lista_tareas_alumnos()
    {
        //$alumnos = Alumnos::all();
        $tareas_alumnos = DB::table('tareas_alumnos')
        ->join('carreras', 'tareas_alumnos.id_carrera', '=', 'carreras.id')
        ->join('semestres', 'tareas_alumnos.id_semestre', '=', 'semestres.id')
        ->join('materias_alumnos', 'tareas_alumnos.id_materia', '=', 'materias_alumnos.id')
        ->select('tareas_alumnos.id as id','tareas_alumnos.titulo as titulo', 
        'tareas_alumnos.descripcion as descripcion',
        'tareas_alumnos.fecha_entrega as fecha_entrega',
        'carreras.nombre_carrera as carrera', 
        'semestres.descripcion_semestre as semestre',
        'materias_alumnos.nombre_materia as nombre_materia')
        ->get();
        return view('lista_tareas_alumnos')
        //->with('contenidonoticias',$contenidonoticias);    
        ->with('tareas_alumnos', $tareas_alumnos);  
    }

    public function agregar_tareas_alumnos()
    {
        $carreras = Carreras::all();
        $semestres = Semestres::all();
        $materias_alumnos = Materias_alumnos::all();
        return view('agregar_tareas_alumnos')
        ->with('carreras', $carreras)
        ->with('semestres', $semestres)
        ->with('materias_alumnos', $materias_alumnos);  
    }

    public function guardar_tareas_alumnos(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string',
            'id_semestre' => 'required|string',
            'id_carrera' => 'required|string',
            'id_materia' => 'required|string',
            'fecha_entrega' => 'required|string',
        ]);

        // Verificar si la tarea ya existe en la base de datos
        $existetarea = Tareas_alumnos::where('titulo', $request->titulo)->exists();
        
        //dd($existetarea);

        if ($existetarea) 
        {
            // Si la tarea ya existe, devolver un mensaje de error
            Session::flash('mensaje',"No se puede guardar la misma tareas con el mismo nombre");
            return back()
            ->withInput(); // Mantener los valores del formulario        
        }
        else
        {
            $tareas_alumnos = new Tareas_alumnos;
            //$regla->numero_pregunta=$request->numero_pregunta;
            $tareas_alumnos->titulo=$request->titulo;
            $tareas_alumnos->descripcion=$request->descripcion;
            $tareas_alumnos->archivo=$request->archivo;
            $tareas_alumnos->fecha_entrega=$request->fecha_entrega;
            $tareas_alumnos->id_carrera=$request->id_carrera;
            $tareas_alumnos->id_materia=$request->id_materia;
            $tareas_alumnos->id_semestre=$request->id_semestre;
            $tareas_alumnos->id_usuario=1;
            $tareas_alumnos->estado=1;

            $tareas_alumnos->save();
            Session::flash('mensaje',"Tarea guardada correctamente");
            return redirect()->route('lista_tareas_alumnos');
        }
    }

    public function editar_tareas_alumnos($id)
    {
            $tareas_alumnos = Tareas_alumnos::where('id',$id)->get();
            // carrera alumno
            $id_carrera=$tareas_alumnos[0]->id_carrera;
            $carrera_alumno = Carreras::where('id',$id_carrera)->get();
            // semestre alumno
            $id_semestre=$tareas_alumnos[0]->id_semestre;
            $semestre_alumno = Semestres::where('id',$id_semestre)->get();
            // materia alumno
            $id_materia=$tareas_alumnos[0]->id_materia;
            $materia_alumno = Materias_alumnos::where('id',$id_materia)->get();
            // todas las carreras
            $carreras = Carreras::all();
            //todos los semestres
            $semestres = Semestres::all();
            //todas las semestres
            $materias = Materias_alumnos::all();
            return view('editar_tareas_alumnos')
            ->with('carrera_alumno', $carrera_alumno)
            ->with('semestre_alumno', $semestre_alumno)
            ->with('materia_alumno', $materia_alumno)
            ->with('carreras', $carreras)
            ->with('semestres', $semestres)
            ->with('materias', $materias)            
            ->with('tareas_alumnos',$tareas_alumnos[0]);
    }

    public function guardar_cambios_tareas_alumnos(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string',
            'id_semestre' => 'required|string',
            'id_materia' => 'required|string',
            'id_carrera' => 'required|string',
            'fecha_entrega' => 'required|string',
        ]);

        // Verificar si la tarea ya existe en la base de datos
        $existetarea = Tareas_alumnos::where('titulo', $request->titulo)->exists();

        if ($existetarea) 
        {
            // Si la tarea ya existe, devolver un mensaje de error
            Session::flash('mensaje',"No se puede guardar la misma tareas con el mismo nombre");
            return back()
            ->withInput(); // Mantener los valores del formulario        
        }
        else
        {
            $tareas_alumnos = Tareas_alumnos::find($request->id);
            $tareas_alumnos->id=$request->id;
            $tareas_alumnos->titulo=$request->titulo;
            $tareas_alumnos->descripcion=$request->descripcion;
            $tareas_alumnos->archivo=$request->archivo;
            $tareas_alumnos->fecha_entrega=$request->fecha_entrega;
            $tareas_alumnos->id_carrera=$request->id_carrera;
            $tareas_alumnos->id_materia=$request->id_materia;
            $tareas_alumnos->id_semestre=$request->id_semestre;


            $tareas_alumnos->save();
            Session::flash('mensaje',"Tarea modificada correctamente");
            return redirect()->route('lista_tareas_alumnos');
        }
    }

    /*
    public function filtrar_semestre_materias(Request $request){
        //dd($request);
        if(isset($request->id_semestre)){
            $materias = Materias_alumnos::where('semestre',$request->id_semestre)->
            where('carrera',$request->id_carrera)->get();
            //$materias = Materias_alumnos::where('semestre','=',$request->id_semestre)
            //->where('carrera', '=', $request->id_carrera)
            //->get();            
            return response()->json(
                [
                    'lista_materias' => $materias,
                    'success' => true
                ]
                );
        }else{
            return response()->json(
                [
                    'success' => false
                ]
                );

        }
    }
    */
    
    public function filtrar_semestre_materias(Request $request)
    {
        // Validación de los parámetros
        $validated = $request->validate([
            'id_semestre' => 'required|integer',  // id_semestre debe ser un entero
            'id_carrera' => 'required|integer',  // id_carrera debe ser un entero
        ]);

        // Realizar la consulta filtrada por semestre y carrera
        $materias = Materias_alumnos::where('semestre', $request->id_semestre)
                                    ->where('carrera', $request->id_carrera)
                                    ->get();

        // Verificar si se encontraron materias
        if ($materias->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No se encontraron materias para los filtros seleccionados.'
            ]);
        }

        // Devolver las materias encontradas en formato JSON
        return response()->json([
            'lista_materias' => $materias,
            'success' => true
        ]);
    }
}
