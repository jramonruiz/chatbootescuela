<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MateriasalumnosImport;
use App\Models\Materias_alumnos;
use App\Models\Carreras;
use App\Models\Semestres;
use Session;

class MateriasalumnosController extends Controller
{
    //
    public function lista_materiasalumnos()
    {
        //$alumnos = Alumnos::all();
        $materiasalumnos = DB::table('materias_alumnos')
        ->join('carreras', 'materias_alumnos.carrera', '=', 'carreras.id')
        ->join('semestres', 'materias_alumnos.semestre', '=', 'semestres.id')
        ->select('materias_alumnos.id as id',
        'materias_alumnos.clave_materia as clave_materia', 
        'materias_alumnos.nombre_materia as nombre_materia',
        'carreras.nombre_carrera as carrera', 
        'semestres.descripcion_semestre as semestre')
        ->get();
        return view('lista_materiasalumnos')
        //->with('contenidonoticias',$contenidonoticias);    
        ->with('materiasalumnos', $materiasalumnos);  
    }

    public function agregar_materiasalumnos()
    {
        $carreras = Carreras::all();
        $semestres = Semestres::all();
        return view('agregar_materiasalumnos')
        ->with('carreras', $carreras)
        ->with('semestres', $semestres);  
    }

    public function guardar_materiasalumnos(Request $request)
    {
        $request->validate([
            'clave_materia' => 'required|string',
            'nombre_materia' => 'required|string',
            'carrera' => 'required|string',
            'semestre' => 'required|string',
        ]);

        // Verificar si la matrícula ya existe en la base de datos
        $existemateria = Materias_alumnos::where('clave_materia', $request->clave_materia)->exists();

        if ($existemateria) 
        {
            // Si la matrícula ya existe, devolver un mensaje de error
            Session::flash('mensaje',"No se puede guardar la materia con la misma clave");
            return back()
            ->withInput(); // Mantener los valores del formulario        
        }
        else
        {
            $materiasalumnos = new Materias_alumnos;
            //$regla->numero_pregunta=$request->numero_pregunta;
            $materiasalumnos->clave_materia=$request->clave_materia;
            $materiasalumnos->nombre_materia=$request->nombre_materia;
            $materiasalumnos->descripcion_materia=$request->descripcion_materia;
            $materiasalumnos->creditos=$request->creditos;
            $materiasalumnos->carrera=$request->carrera;
            $materiasalumnos->semestre=$request->semestre;

            $materiasalumnos->save();
            Session::flash('mensaje',"Materia guardada correctamente");
            return redirect()->route('lista_materiasalumnos');
        }
    }

    public function editar_materiasalumnos($id)
    {
            $materiasalumnos = Materias_alumnos::where('id',$id)->get();
            // carrera materia
            $id_carrera=$materiasalumnos[0]->carrera;
            $carrera_materia = Carreras::where('id',$id_carrera)->get();
            // semestre materia
            $id_semestre=$materiasalumnos[0]->semestre;
            $semestre_materia = Semestres::where('id',$id_semestre)->get();
            // todas las carreras
            $carreras = Carreras::all();
            //todos los semestres
            $semestres = Semestres::all();
            return view('editar_materiasalumnos')
            ->with('carrera_materia', $carrera_materia)
            ->with('semestre_materia', $semestre_materia)
            ->with('carreras', $carreras)
            ->with('semestres', $semestres)
            ->with('materiasalumnos',$materiasalumnos[0]);
    }

    public function guardar_cambios_materiasalumnos(Request $request)
    {
        $request->validate([
            'nombre_materia' => 'required|string',
            'carrera' => 'required|string',
            'semestre' => 'required|string',
        ]);

            $materiasalumnos = Materias_alumnos::find($request->id);

            $materiasalumnos->id=$request->id;
            $materiasalumnos->nombre_materia=$request->nombre_materia;
            $materiasalumnos->descripcion_materia=$request->descripcion_materia;
            $materiasalumnos->creditos=$request->creditos;
            $materiasalumnos->carrera=$request->carrera;
            $materiasalumnos->semestre=$request->semestre;

            $materiasalumnos->save();
            Session::flash('mensaje',"Materia modificada correctamente");
            return redirect()->route('lista_materiasalumnos');
    }

    public function importar_materiasalumnos()
    {
        return view('importar_materiasalumnos');
    }

    public function import_excel_materias(Request $request)
    {
        $request->validate([
            'archivo' => 'required|file|mimes:xlsx,xls',
        ]);

      // Inicializamos los contadores de registros
      $insertedCount = 0;
      $updatedCount = 0;
      $updatedCount = 0;      
      $totalregistros = 0;   
      $totalCount = 0; 

        try {        
            // Instanciamos la clase de importación
            $import = new MateriasalumnosImport();

            Excel::import($import, $request->file('archivo'));

            // Obtenemos los contadores de registros insertados y actualizados
            $insertedCount = $import->getInsertedCount();
            $updatedCount = $import->getUpdatedCount();
            $totalregistros = $import->gettotalregistros();
            $registros_insertados=$totalregistros-$updatedCount;

            $totalCount = $insertedCount + $updatedCount;
            
            Session::flash('mensaje',"Importación completada. Registros Insertados: {$registros_insertados}, Registros Actualizados: {$updatedCount}, Total: {$totalregistros}");
            return redirect()->route('lista_materiasalumnos');        
        
        //} catch (\Exception $e) {
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            // Captura los errores de validación y devuélvelos
            $failures = $e->failures();  
            
            // Convertir los errores en un string para mostrar
            $errorMessages = '';
            foreach ($failures as $failure) {
                // Puedes personalizar esto según tus necesidades
                $errorMessages .= 'En la Fila ' . $failure->row() . ' del excel: ' . implode(', ', $failure->errors()) . "\n";
            }            

            // Convertir los saltos de línea en etiquetas <br> para HTML
            $errorMessages = nl2br($errorMessages);

            // Captura cualquier error y muestra el mensaje
            //Session::flash('mensaje',"Hubo un error al importar el archivo: " . $e->getMessage());
            
            //Session::flash('mensaje',"Hubo un error al importar el archivo: " . $failures);            
            Session::flash('mensaje', "Hubo un error al importar el archivo: <br>" . $errorMessages);
            
            return redirect()->route('lista_materiasalumnos');
        
            //->with('error', 'Hubo un error al importar el archivo: ' . $e->getMessage());
        
        }
    }

}
