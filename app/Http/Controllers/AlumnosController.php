<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AlumnosImport;
use App\Models\Alumnos;
use App\Models\Carreras;
use App\Models\Semestres;
use Session;

class AlumnosController extends Controller
{
    //
    public function lista_alumnos()
    {
        //$alumnos = Alumnos::all();
        $alumnos = DB::table('alumnos')
        ->join('carreras', 'alumnos.carrera', '=', 'carreras.id')
        ->join('semestres', 'alumnos.semestre', '=', 'semestres.id')
        ->select('alumnos.id as id','alumnos.nombre as nombre', 'alumnos.apellido_paterno as apellido_paterno',
        'alumnos.apellido_materno as apellido_materno','alumnos.matricula as matricula',
         'carreras.nombre_carrera as carrera', 'semestres.descripcion_semestre as semestre')
        ->get();
        return view('lista_alumnos')
        //->with('contenidonoticias',$contenidonoticias);    
        ->with('alumnos', $alumnos);  
    }

    public function agregar_alumno()
    {
        $carreras = Carreras::all();
        $semestres = Semestres::all();
        return view('agregar_alumno')
        ->with('carreras', $carreras)
        ->with('semestres', $semestres);  
    }

    public function guardar_alumno(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'apellido_paterno' => 'required|string',
            'apellido_materno' => 'required|string',
            'fecha_nacimiento' => 'required|string',
            'sexo' => 'required|string',
            'correo_electronico' => 'required|string',
            'telefono' => 'required|string',
            'direccion' => 'required|string',
            'matricula' => 'required|string',
            'fecha_ingreso' => 'required|string',
            'estado' => 'required|string',
            'carrera' => 'required|string',
            'semestre' => 'required|string',
            'estatus' => 'required|string',
        ]);

        // Verificar si la matrícula ya existe en la base de datos
        $existeMatricula = Alumnos::where('matricula', $request->matricula)->exists();

        if ($existeMatricula) 
        {
            // Si la matrícula ya existe, devolver un mensaje de error
            Session::flash('mensaje',"No se puede guardar el alumno con la misma matricula");
            return back()
            ->withInput(); // Mantener los valores del formulario        
        }
        else
        {
            $alumno = new Alumnos;
            //$regla->numero_pregunta=$request->numero_pregunta;
            $alumno->nombre=$request->nombre;
            $alumno->apellido_paterno=$request->apellido_paterno;
            $alumno->apellido_materno=$request->apellido_materno;
            $alumno->fecha_nacimiento=$request->fecha_nacimiento;
            $alumno->sexo=$request->sexo;
            $alumno->correo_electronico=$request->correo_electronico;
            $alumno->telefono=$request->telefono;
            $alumno->direccion=$request->direccion;
            $alumno->matricula=$request->matricula;
            $alumno->fecha_ingreso=$request->fecha_ingreso;
            $alumno->estado=$request->estado;
            $alumno->carrera=$request->carrera;
            $alumno->semestre=$request->semestre;
            $alumno->estatus=$request->estatus;

            $alumno->save();
            Session::flash('mensaje',"Alumno guardada correctamente");
            return redirect()->route('lista_alumnos');
        }
    }

    public function editar_alumno($id)
    {
            $alumnos = Alumnos::where('id',$id)->get();
            // carrera alumno
            $id_carrera=$alumnos[0]->carrera;
            $carrera_alumno = Carreras::where('id',$id_carrera)->get();
            // semestre alumno
            $id_semestre=$alumnos[0]->semestre;
            $semestre_alumno = Semestres::where('id',$id_semestre)->get();
            // todas las carreras
            $carreras = Carreras::all();
            //todos los semestres
            $semestres = Semestres::all();
            return view('editar_alumno')
            ->with('carrera_alumno', $carrera_alumno)
            ->with('semestre_alumno', $semestre_alumno)
            ->with('carreras', $carreras)
            ->with('semestres', $semestres)
            ->with('alumnos',$alumnos[0]);
    }

    public function guardar_cambios_alumno(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'apellido_paterno' => 'required|string',
            'apellido_materno' => 'required|string',
            'fecha_nacimiento' => 'required|string',
            'sexo' => 'required|string',
            'correo_electronico' => 'required|string',
            'telefono' => 'required|string',
            'direccion' => 'required|string',
            'fecha_ingreso' => 'required|string',
            'estado' => 'required|string',
            'carrera' => 'required|string',
            'semestre' => 'required|string',
            'estatus' => 'required|string',
        ]);

            $alumno = Alumnos::find($request->id);

            $alumno->id=$request->id;
            $alumno->nombre=$request->nombre;
            $alumno->apellido_paterno=$request->apellido_paterno;
            $alumno->apellido_materno=$request->apellido_materno;
            $alumno->fecha_nacimiento=$request->fecha_nacimiento;
            $alumno->sexo=$request->sexo;
            $alumno->correo_electronico=$request->correo_electronico;
            $alumno->telefono=$request->telefono;
            $alumno->direccion=$request->direccion;
            $alumno->fecha_ingreso=$request->fecha_ingreso;
            $alumno->estado=$request->estado;
            $alumno->carrera=$request->carrera;
            $alumno->semestre=$request->semestre;
            $alumno->estatus=$request->estatus;


            $alumno->save();
            Session::flash('mensaje',"Alumno modificada correctamente");
            return redirect()->route('lista_alumnos');
    }

    public function importar_alumnos()
    {
        return view('importar_alumnos');
    }


    public function importar_excel_alumnos(Request $request)
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
            //Excel::import(new AlumnosImport, $request->file('archivo'));
            // Importamos el archivo y contamos los registros insertados y actualizados
            
            
            /*
            Excel::import(new AlumnosImport(function ($importedRow) use (&$insertedCount, &$updatedCount){
                \Log::info('Importado:', $importedRow); // Verifica si las filas se están procesando
                if ($importedRow === null) {
                    $updatedCount++; // Si no se insertó un nuevo registro, se actualizó
                } else {
                    $insertedCount++; // Si se insertó un nuevo registro
                }
            }), $request->file('archivo'));

            // Log de contadores
            \Log::info("Registros insertados: {$insertedCount}, Actualizados: {$updatedCount}");
            
            */

            // Instanciamos la clase de importación
            $import = new AlumnosImport();

            Excel::import($import, $request->file('archivo'));

            // Obtenemos los contadores de registros insertados y actualizados
            $insertedCount = $import->getInsertedCount();
            $updatedCount = $import->getUpdatedCount();
            $totalregistros = $import->gettotalregistros();
            $registros_insertados=$totalregistros-$updatedCount;

            $totalCount = $insertedCount + $updatedCount;
            
            Session::flash('mensaje',"Importación completada. Registros Insertados: {$registros_insertados}, Registros Actualizados: {$updatedCount}, Total: {$totalregistros}");
            return redirect()->route('lista_alumnos');        
        
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
            
            return redirect()->route('lista_alumnos');
        
            //->with('error', 'Hubo un error al importar el archivo: ' . $e->getMessage());
        
        }
    }
        
}
