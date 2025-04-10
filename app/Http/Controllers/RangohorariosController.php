<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rangohorarios;
use Session;

class RangohorariosController extends Controller
{
    //
    public function lista_rango_horarios()
    {
        $rango_horarios = Rangohorarios::all();
        return view('lista_rango_horarios')
        ->with('rango_horarios', $rango_horarios);  
    }

    public function agregar_rango_horarios()
    {
        return view('agregar_rango_horarios');
    }

    public function guardar_rango_horarios(Request $request)
    {
        $request->validate([
            'descripcion_rango_horario' => 'required|string',
        ]);

        $existe_rango_horario = Rangohorarios::where('descripcion_rango_horario', $request->descripcion_rango_horario)->count()>0;

        if ($existe_rango_horario) 
        {
            Session::flash('mensaje',"No se puede guardar un mismo rango de horario");
            return redirect()->back();        
        } 
        else 
        {
            $rango_horarios = new Rangohorarios;
            $rango_horarios->descripcion_rango_horario=$request->descripcion_rango_horario;
         
            $rango_horarios->save();
            Session::flash('mensaje',"Rango de horario guardado correctamente");
            return redirect()->route('lista_rango_horarios');
        }
    }

    public function editar_rango_horarios($id)
    {
            $rango_horarios = Rangohorarios::where('id',$id)->get();
            return view('editar_rango_horarios')
            ->with('rango_horarios',$rango_horarios[0]);
    }

    public function guardar_cambios_rango_horarios(Request $request)
    {
        $request->validate([
            'descripcion_rango_horario' => 'required|string',
        ]);

        $existe_rango_horarios = Rangohorarios::where('descripcion_rango_horario', $request->descripcion_rango_horario)->count()>0;

        if ($existe_rango_horarios) 
        {
            Session::flash('mensaje',"No se puede guardar un mismo rango de horario");
            return redirect()->back();        
        } 
        else 
        {
            $rango_horarios = Rangohorarios::find($request->id);

            $rango_horarios->id=$request->id;
            $rango_horarios->descripcion_rango_horario=$request->descripcion_rango_horario;

            $rango_horarios->save();
            Session::flash('mensaje',"Rango de horario modificado correctamente");
            return redirect()->route('lista_rango_horarios');
        }
    }

}
