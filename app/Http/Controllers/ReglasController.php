<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reglas;
use App\Models\Tiporespuestas;
use Session;

class ReglasController extends Controller
{
    //

    public function lista_reglas()
    {
        $reglas = Reglas::all();
        return view('lista_reglas')
        //->with('contenidonoticias',$contenidonoticias);    
        ->with('reglas', $reglas);  
    }

    public function agregar_regla()
    {
            $reglas = Reglas::all();
            //$numero_preguntas = Reglas::count();
            $numero_preguntas = Reglas::latest('numero_pregunta')->first();
            $numero_pregunta_siguiente=$numero_preguntas->numero_pregunta+1;
            return view('agregar_regla')
            ->with('reglas', $reglas)
            ->with('numero_pregunta_siguiente', $numero_pregunta_siguiente);  

    }

    public function guardar_regla(Request $request)
    {
        $request->validate([
            'numero_pregunta' => 'required|string',
            'source' => 'required|string',
            'tipo_respuesta' => 'required|string',
            'source2' => 'required|string',
        ]);

        $existe_tipo_regla = Reglas::where('url_respuestas', $request->url_respuestas)->count()>0;

        if ($existe_tipo_regla) 
        {
            Session::flash('mensaje',"No se puede guardar una misma regla con el mismo tipo de respuesta");
            return redirect()->back();        
        } 
        else 
        {
            $regla = new Reglas;
            $regla->numero_pregunta=$request->numero_pregunta;
            $regla->descripcion_pregunta=$request->source;
            $regla->tipo_respuesta=$request->tipo_respuesta;
            $regla->description_respuesta=$request->source2;
            $regla->url_respuestas=$request->url_respuestas;
         
            $regla->save();
            Session::flash('mensaje',"Regla guardada correctamente");
            return redirect()->route('lista_reglas');
        }

    }

    public function editar_regla($id)
    {
            $reglas = Reglas::where('id',$id)->get();
            $tipo_respuestas = Tiporespuestas::all();
            return view('editar_regla')
            ->with('reglas',$reglas[0])
            ->with('tipo_respuestas',$tipo_respuestas);
    }

    public function guardar_cambios_regla(Request $request)
    {
        $request->validate([
            'numero_pregunta' => 'required|string',
            'source' => 'required|string',
            'tipo_respuesta' => 'required|string',
            'source2' => 'required|string',
        ]);

            $regla = Reglas::find($request->id);

            $regla->id=$request->id;
            $regla->numero_pregunta=$request->numero_pregunta;
            $regla->descripcion_pregunta=$request->source;
            $regla->tipo_respuesta=$request->tipo_respuesta;
            $regla->description_respuesta=$request->source2;
            //$regla->url_respuestas=$request->url_respuestas;

            $regla->save();
            Session::flash('mensaje',"Regla modificada correctamente");
            return redirect()->route('lista_reglas');
    }

}
