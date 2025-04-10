<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tiporespuestas;
use Session;

class TiporespuestasController extends Controller
{
    //
    public function lista_tiporespuestas()
    {
        $tiporespuestas = Tiporespuestas::all();
        return view('lista_tipo_respuestas')
        //->with('contenidonoticias',$contenidonoticias);    
        ->with('tiporespuestas', $tiporespuestas);  
    }

    public function agregar_tiporespuesta()
    {
            return view('agregar_tiporespuesta');
    }

    public function guardar_tiporespuesta(Request $request)
    {

        $request->validate([
            'id_tipo_usuario' => 'required|string',
            'descripcion_respuesta' => 'required|string',
        ]);

        $respuestacompleta=$request->descripcion_respuesta;
        $cadenacompleta=$respuestacompleta;
        //$cadenasinespacios=trim(str_replace([" ", "\n", "\t", "\r"], "", $cadenacompleta));
        $cadenasinespacios = str_replace(" ","_",$cadenacompleta);
        $descripcion_respuesta=strtolower($cadenasinespacios); 

        $existe_tipo_respuesta = Tiporespuestas::where('descripcion_respuesta', $descripcion_respuesta)->count()>0;

        if ($existe_tipo_respuesta) 
        {
            Session::flash('mensaje',"No se puede guardar una misma tipo respuesta");
            return redirect()->back();        
        } 
        else 
        {
            $tiporespuesta = new Tiporespuestas;

            $tiporespuesta->id_tipo_usuario=$request->id_tipo_usuario;
            $tiporespuesta->descripcion_respuesta=$descripcion_respuesta;
            $tiporespuesta->descripcion_respuesta_chatboot=$request->descripcion_respuesta_chatboot;
            $tiporespuesta->respuesta_completa=$request->descripcion_respuesta;
        
            $tiporespuesta->save();
            Session::flash('mensaje',"Tipo de respuesta guardada correctamente");
            return redirect()->route('lista_tiporespuestas');
        }
    }

    public function editar_tiporespuesta($id)
    {
            $tiporespuestas = Tiporespuestas::where('id',$id)->get();
            return view('editar_tiporespuesta')
            ->with('tiporespuestas',$tiporespuestas[0]);
    }

    public function guardar_cambios_tiporespuesta(Request $request)
    {
        $request->validate([
            'id_tipo_usuario' => 'required|string',
            'descripcion_respuesta' => 'required|string',
        ]);

        $respuestacompleta=$request->descripcion_respuesta;
        $cadenacompleta=$respuestacompleta;
        //$cadenasinespacios=trim(str_replace([" ", "\n", "\t", "\r"], "", $cadenacompleta));
        $cadenasinespacios = str_replace(" ","_",$cadenacompleta);
        $descripcion_respuesta=strtolower($cadenasinespacios); 

        $tiporespuesta = Tiporespuestas::find($request->id);

        $tiporespuesta->id=$request->id;
        $tiporespuesta->id_tipo_usuario=$request->id_tipo_usuario;
        $tiporespuesta->descripcion_respuesta=$descripcion_respuesta;
        $tiporespuesta->descripcion_respuesta_chatboot=$request->descripcion_respuesta_chatboot;
        $tiporespuesta->respuesta_completa=$request->descripcion_respuesta;

        $tiporespuesta->save();
        Session::flash('mensaje',"Tipo de respuesta modificada correctamente");
        return redirect()->route('lista_tiporespuestas');
    }
}
