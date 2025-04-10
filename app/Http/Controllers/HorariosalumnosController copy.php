<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horarios_alumnos;
use Illuminate\Support\Facades\DB;
use App\Models\Carreras;
use App\Models\Semestres;
use App\Models\Materias_alumnos;
use Session;

class HorariosalumnosController extends Controller
{
    //
    public function agregar_horarios_alumnos()
    {
        $carreras = Carreras::all();
        $semestres = Semestres::all();
        $materias_alumnos = Materias_alumnos::all();
        return view('agregar_horarios_alumnos')
        ->with('carreras', $carreras)
        ->with('semestres', $semestres)
        ->with('materias_alumnos', $materias_alumnos);  
    }

    public function guardar_horarios_alumnos(Request $request)
    {
        //dd($request->all()); // Verifica qué datos estás recibiendo
        // Validar los datos recibidos del formulario
        /*
        $request->validate([
            'id_carrera' => 'required|string',
            'id_semestre' => 'required|string',
            'id_materia' => 'required|string',
            'horarios' => 'required|array',
            'horarios.*.rango_horario' => 'required|string', // Validar que haya un rango horario para cada día
        ]);
        */

        $validated = $request->validate([
            'id_carrera' => 'required|string',
            'id_semestre' => 'required|string',
            'id_materia' => 'required|string',
            'horarios' => 'required|array',
            'horarios.*.rango_horario' => 'nullable|string', // Validar que haya un rango horario para cada día
            'horarios.*.dia_semana' => 'nullable|string',
            'horarios.*.id_materia' => 'nullable|string',
        ]);

        // Recuperar los valores de carrera, semestre y materia
        $idCarrera = $validated['id_carrera'];
        $idSemestre = $validated['id_semestre'];
        $idMateria = $validated['id_materia'];   
        
        // Verificar si la tarea ya existe en la base de datos
        $existetarea = Horarios_alumnos::where('titulo', $request->titulo)->exists();
        
        
            // Guardar los horarios por día
            foreach ($validated['horarios'] as $dia => $horario) {
                $rango_horario = !empty($horario['rango_horario']) ? $horario['rango_horario'] : '---';  // Si no hay valor, usar '---'

                Horarios_alumnos::create([
                    'dia_semana' => $dia,  // Día de la semana
                    'id_carrera' => $idCarrera,  // Carrera seleccionada
                    'id_semestre' => $idSemestre,  // Semestre seleccionado
                    'id_materia' => $idMateria,  // Materia seleccionada
                    'id_usuario' => 1,  // Materia seleccionada
                    'rango_horario' => $rango_horario,  // Rango de horario para ese día
                ]);
                

            // Redirigir al listado de horarios con un mensaje de éxito
            Session::flash('mensaje',"Horario de la materia guardado correctamente");
            return redirect()->route('agregar_horarios_alumnos');
        }
    }
}
