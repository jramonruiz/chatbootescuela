<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuarios;
use App\Models\Reglas;
use Illuminate\Support\Str;
use Session;

/* este software tiene 4 perfiles:
    1: superadmin
    2: administrador - director
    3: docente - administrativo
    4: alumno
*/
class UsuariosController extends Controller
{
    //
    public function lista_usuarios()
    {
        $usuarios = Usuarios::all();
        return view('lista_usuarios')
        ->with('usuarios',$usuarios);
    }

    public function agregar_usuario()
    {
            return view('agregar_usuario');
    }

    public function guardar_usuario(Request $request)
    {
        $request->validate([
            'nombre_completo' => 'required|string',
            'username' => 'required|string',
            'clave' => 'required|string',
            'numero_telefono' => 'required|string',
            'email' => 'required|string',
            'id_tipo_usuario' => 'required|integer',
            'activo' => 'required|integer',
        ]);

        $fechahoy = date('Y-m-d'); // Formato: Año-Mes-Día

        $usuarios = new Usuarios;
        $usuarios->nombre_completo=$request->nombre_completo;
        $usuarios->username=$request->username;
        //$usuarios->clave=$request->clave;
        $usuarios->clave=Hash::make($request->clave);
        $usuarios->clave_desencriptada=$request->clave;
        $usuarios->numero_telefono=$request->numero_telefono;
        $usuarios->email=$request->email;     
        $usuarios->id_tipo_usuario=$request->id_tipo_usuario;     
        $usuarios->activo=$request->activo;
        $usuarios->direccion='';
        $usuarios->codigo_postal='';
        $usuarios->pais='';
        $usuarios->estado='';
        $usuarios->ciudad='';
        $usuarios->nombre_compania='';
        $usuarios->url_compania='';

        $id_tipo_usuario=$request->id_tipo_usuario;     

        $usuarios->inicia=$fechahoy;
        $usuarios->termina=$fechahoy;

        // Verificar si ya existe un usuario con la misma combinación de email y username
        if (Usuarios::where('email', $request->email)
            ->where('username', $request->username)
            ->exists()) 
        {
            //dd('si existe el usuario');
            Session::flash('mensaje',"El nombre de usuario o correo electronico ya existen");
            return redirect()->back()->withInput();
        }
        else
        {
            //dd('no existe el usuario');
            //esto es para que no se repita la APIKEY la cadena aleatoria generada aleatoriamente
            if($id_tipo_usuario==2)
            {
                $usuarios->apikey="";
            }
            else
            {
                $cadena_aleatoria=Str::random(20);
                $usuario_cadena=$request->username.$cadena_aleatoria;
                $usuarios->apikey=$usuario_cadena;
            }
    
            $usuarios->save();
            Session::flash('mensaje',"Usuario guardado correctamente");
            return redirect()->route('lista_usuarios');    
        
        }   
    
        //Contenidonoticias::create($request->all());
        //return redirect()->route('contenidonoticias.index')->with('success', 'Fuente agregada correctamente.');
    }
    
    public function editar_usuario($id)
    {
        $usuarios = Usuarios::where('id',$id)->get();
        return view('editar_usuario')
        ->with('usuarios',$usuarios[0]);
    }

    public function guardar_cambios_usuarios(Request $request)
    {

        $fechahoy = date('Y-m-d'); // Formato: Año-Mes-Día

        $request->validate([
            'nombre_completo' => 'required|string',
            'clave' => 'required|string',
            'numero_telefono' => 'required|string',
            'activo' => 'required|integer',
        ]);

        $usuarios = Usuarios::find($request->id);
        $usuarios->nombre_completo=$request->nombre_completo;
        //$usuarios->clave=$request->clave;
        $usuarios->clave=Hash::make($request->clave);
        $usuarios->clave_desencriptada=$request->clave;
        $usuarios->numero_telefono=$request->numero_telefono;
        $usuarios->activo=$request->activo; 
        //$usuarios->apikey=Str::random(20);
        $usuarios->inicia=$fechahoy;
        $usuarios->termina=$fechahoy;     
        $usuarios->save();
        Session::flash('mensaje',"Usuario modificado correctamente");
        return redirect()->route('lista_usuarios');
    }    

    public function login()
    {
        return view('login');
    }
    
    public function validar(Request $request)
    {
        $this->validate($request,[
            'username' => 'required',
            'clave' => 'required',
        ]);

        // Buscar el usuario por nombre de usuario
        $user = Usuarios::where('username', $request->input('username'))->first();

        // Verificar si el usuario existe y la contraseña es correcta
        if ($user && Hash::check($request->input('clave'), $user->clave)) 
        {
            // Iniciar sesión
            Session::put('sessionnombrecompleto',$user->nombre_completo);
            Session::put('sessionidtipousuario',$user->id_tipo_usuario);
            Session::put('sessionidusuario',$user->id);
            return redirect()->route('principal');
        }
        else
        {
            Session::flash('mensaje',"El usuario o clave son incorrectos");
            return redirect()->route('login');
        }

    }   

    public function principal()
    {
        //return view('lista_contenido_noticias');

        $sessionnombrecompleto=session('sessionnombrecompleto');
        $sessionidtipousuario=session('sessionidtipousuario');
        $sessionidusuario=session('sessionidusuario');

        if($sessionidtipousuario<>"")
        {
            if($sessionidtipousuario==1)
            {
                $reglas = Reglas::all();
                return view('lista_reglas')
                //->with('reglas',$reglas);   
                ->with('reglas', $reglas)->with('sessionidtipousuario', $sessionidtipousuario);   
            }
            else
            {
                $reglas = Reglas::all();
                return view('lista_reglas')
                //->with('reglas',$reglas);   
                ->with('reglas', $reglas)->with('sessionidtipousuario', $sessionidtipousuario);   
            }
        }
        else
        {
            return redirect()->route('login'); 
        }

    }

    public function cerrarsesion()
    {
        Session::forget('sessionnombrecompleto');
        Session::forget('sessionidtipousuario');
        Session::forget('sessionidusuario');
        Session::flush();
        Session::flash('mensaje',"Sesion cerrada correctamente");
        return redirect()->route('login');
    }

    public function registro_empresa()
    {
        return view('registro_empresa');
    }   

    public function registro_datos_empresa(Request $request)
    {
        //dd($request);
        $request->validate([
            'nombre_completo' => 'required|string',
            'username' => 'required|string',
            'clave' => 'required|string',
            'clave_repetir' => 'required|string',
            'numero_telefono' => 'required|string',
            'email' => 'required|string',
            'direccion' => 'required|string',
            'codigo_postal' => 'required|string',
            'estado' => 'required|string',
            'ciudad' => 'required|string',
            'nombre_compania' => 'required|string',
            'url_compania' => 'required|string',            
        ]);

        $fechahoy = date('Y-m-d'); // Formato: Año-Mes-Día

        $clave=$request->clave;
        $clave_repetir=$request->clave_repetir;


        //dd($clave);
        if($clave==$clave_repetir)
        {
            $usuarios = new Usuarios;
            $usuarios->nombre_completo=$request->nombre_completo;
            $usuarios->username=$request->username;
            //$usuarios->clave=$request->clave;
            $usuarios->clave_desencriptada=$request->clave;
            $usuarios->clave=Hash::make($request->clave);
            $usuarios->numero_telefono=$request->numero_telefono;
            $usuarios->email=$request->email;   
            $usuarios->direccion=$request->direccion;
            $usuarios->codigo_postal=$request->codigo_postal;
            $usuarios->estado=$request->estado;
            $usuarios->ciudad=$request->ciudad;
            $usuarios->nombre_compania=$request->nombre_compania;
            $usuarios->url_compania=$request->url_compania;  
            $usuarios->id_tipo_usuario=2;     
            $usuarios->activo=1;
            $usuarios->pais='';
            //$usuarios->apikey=Str::random(20);
            $usuarios->inicia=$fechahoy;
            $usuarios->termina=$fechahoy;    
            
            // Verificar si ya existe un usuario con la misma combinación de email y username
            if (Usuarios::where('email', $request->email)
                ->where('username', $request->username)
                ->exists()) 
            {
                //dd('si existe el usuario');
                Session::flash('mensaje',"El nombre de usuario o correo electronico ya existen");
                return redirect()->back()->withInput();
            }
            else
            {
                // esto es para evitar que se repita la APIKEY generada manualmente
                $cadena_aleatoria=Str::random(20);
                $usuario_cadena=$request->username.$cadena_aleatoria;
                $usuarios->apikey=$usuario_cadena;


                $usuarios->save();
                Session::flash('mensaje',"Registro guardado correctamente, ahora puedes iniciar sesion con tu usuario y clave");
                return redirect()->route('login');
            }
        }
        else
        {
            Session::flash('mensaje',"Las claves no coinciden");
            return redirect()->back()->withInput();
        }
    }   
    
    public function recuperar_clave()
    {
        return view('recuperar_clave');
    }

    public function enviar_enlace_cambiar_clave(Request $request)
    {
        $email=$request->email;
        $usuarios = Usuarios::where('email',$email)->get();
        //$email_para_enviar_enlace=$usuarios[0]->id;
        //dd($usuarios);
        if (isset($usuarios[0])) {
            // Acceder al índice
            $email_para_enviar_enlace = $usuarios[0]->email;
        } else {
            // Manejar el caso en que no existe
            $email_para_enviar_enlace="";        }
        
        if($email_para_enviar_enlace=="")
        {
            Session::flash('mensaje',"El correo eletronico no coincide con el que te diste de alta");
            return redirect()->back()->withInput();
        }
        else
        {
        // aqui va el codigo para enviar al correo eletronico el enlace para cambiar clave
        // investigarlo y colocar en codigo cuando ya este la aplicacion en el servidor
        // FALTA GENERAR LA CADENA DEL ENLACE PENSANDO EN ELLO 30-10-2024
        Session::flash('mensaje',"Se he enviado un enlace a tu correo electronico para la recuperacion de tu clave");
        return redirect()->route('login');
        
        }
    }

    /*
    public function formulario_cambiar_clave($id,$username,$clave,$numero_telefono,$email,$inicia,$termina)
    {
        $usuarios = Usuarios::where('id',$id)->get();
        return view('editar_usuario')
        ->with('usuarios',$usuarios[0]);
    }
    */

    public function ver_perfil($id)
    {
        $sessionnombrecompleto=session('sessionnombrecompleto');
        $sessionidtipousuario=session('sessionidtipousuario');
        $sessionidusuario=session('sessionidusuario');

        if($sessionidtipousuario<>"")
        {   
            if($id==$sessionidusuario)
            {
            $usuarios = Usuarios::where('id',$id)->get();
            return view('ver_perfil')
            ->with('usuarios',$usuarios[0]);
            }
            else
            {
                $usuarios = Usuarios::where('id',$sessionidusuario)->get();
                return view('ver_perfil')
                ->with('usuarios',$usuarios[0]);
            }
        }
        else
        {
            return redirect()->route('login');    
        }
    }

    public function guardar_cambios_perfil(Request $request)
    {
        $request->validate([
            'clave' => 'required|string',
            'numero_telefono' => 'required|string',
            'email' => 'required|string',
        ]);

        $usuarios = Usuarios::find($request->id);
        $id_tipo_usuario=$request->id_tipo_usuario;
        if($id_tipo_usuario==3)
        {
            //$usuarios->clave=$request->clave;
            $usuarios->clave_desencriptada=$request->clave;
            $usuarios->clave=Hash::make($request->clave);
            $usuarios->numero_telefono=$request->numero_telefono;
            $usuarios->email=$request->email;   
            $usuarios->direccion=$request->direccion;
            $usuarios->codigo_postal=$request->codigo_postal;
            $usuarios->estado=$request->estado;
            $usuarios->ciudad=$request->ciudad;
            $usuarios->nombre_compania=$request->nombre_compania;
            $usuarios->url_compania=$request->url_compania;  
        }
        if($id_tipo_usuario==4)
        {
            //$usuarios->clave=$request->clave;
            $usuarios->clave_desencriptada=$request->clave;
            $usuarios->clave=Hash::make($request->clave);
            $usuarios->numero_telefono=$request->numero_telefono;
            $usuarios->email=$request->email;       
        }
        $usuarios->save();        
        Session::flash('mensaje',"Datos modificado correctamente");
        return redirect()->back()->withInput();
    }

}
