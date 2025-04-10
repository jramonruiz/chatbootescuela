<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CarrerasImport;
use App\Models\Carreras;
use Session;


class CarrerasController extends Controller
{
    //
    public function lista_carreras()
    {
        $carreras = Carreras::all();
        return view('lista_carreras')
        ->with('carreras', $carreras);  
    }

    public function agregar_carreras()
    {
        return view('agregar_carreras');
    }

    public function guardar_carreras(Request $request)
    {
        $request->validate([
            'nombre_carrera' => 'required|string',
        ]);

        $existe_carrera = Carreras::where('nombre_carrera', $request->nombre_carrera)->count()>0;

        if ($existe_carrera) 
        {
            Session::flash('mensaje',"No se puede guardar una misma carrera con el mismo nombre");
            return redirect()->back();        
        } 
        else 
        {
            $carrera = new Carreras;
            $carrera->nombre_carrera=$request->nombre_carrera;
         
            $carrera->save();
            Session::flash('mensaje',"Carrera guardada correctamente");
            return redirect()->route('lista_carreras');
        }
    }

    public function editar_carreras($id)
    {
            $carreras = Carreras::where('id',$id)->get();
            return view('editar_carreras')
            ->with('carreras',$carreras[0]);
    }

    public function guardar_cambios_carreras(Request $request)
    {
        $request->validate([
            'nombre_carrera' => 'required|string',
        ]);

        $existe_carrera = Carreras::where('nombre_carrera', $request->nombre_carrera)->count()>0;

        if ($existe_carrera) 
        {
            Session::flash('mensaje',"No se puede guardar una misma carrera con el mismo nombre");
            return redirect()->back();        
        } 
        else 
        {
            $carreras = Carreras::find($request->id);

            $carreras->id=$request->id;
            $carreras->nombre_carrera=$request->nombre_carrera;

            $carreras->save();
            Session::flash('mensaje',"Carrera modificada correctamente");
            return redirect()->route('lista_carreras');
        }
    }

    public function importar_carreras()
    {
        return view('importar_carreras');
    }

    public function import_excel_carreras(Request $request)
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
            $import = new CarrerasImport();

            Excel::import($import, $request->file('archivo'));

            // Obtenemos los contadores de registros insertados y actualizados
            $insertedCount = $import->getInsertedCount();
            $updatedCount = $import->getUpdatedCount();
            $totalregistros = $import->gettotalregistros();
            $registros_insertados=$totalregistros-$updatedCount;

            $totalCount = $insertedCount + $updatedCount;
            
            Session::flash('mensaje',"Importación completada. Registros Insertados: {$registros_insertados}, Registros Actualizados: {$updatedCount}, Total: {$totalregistros}");
            return redirect()->route('lista_carreras');        
        
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
            
            return redirect()->route('lista_carreras');
        
            //->with('error', 'Hubo un error al importar el archivo: ' . $e->getMessage());
        
        }
    }
}
