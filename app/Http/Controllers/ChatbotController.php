<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reglas;

class ChatbotController extends Controller
{
    //
    public function index()
    {
        return view('chatbot');
    }

    public function handleMessage(Request $request)
    {
        $message = $request->input('message');
        $response = $this->generateResponse($message);
        
        return response()->json(['message' => $response]);
    }

    private function generateResponse($message)
    {
        // Aquí puedes agregar reglas simples o integrar una API de NLP
        $message = strtolower($message);

        /*
        if (strpos($message, 'numerocontrol') !== false) {
        return "📌Por favor, ingresa un numero de la opcion del menu para poder ayudarte: con la información que me solicites<br>1️⃣. Descargar boleta de calificacion. 📄<br>2️⃣. Descargar constancia de estudio. 📄<br>3️⃣. Descargar kardex de calificaciones. 📄<br>4️⃣. Descargar horario de Clases. 🕜";
        }
        else if (strpos($message, '1') !== false) {
            return "Tu boleta lo puedes consultar y descargar en el siguiente link: <a href='www.boleta.com'>www.boleta.com</a>";
        } 
        elseif (strpos($message, '2') !== false) {
            return "Tu constancia de calificaciones lo puedes consultar y descargar en el siguiente link: <a href='www.boleta.com'>www.boleta.com</a>";
        } 
        elseif (strpos($message, '3') !== false) {
            return "Tu Kardex de calificaciones lo puedes consultar y descargar en el siguiente link: <a href='www.boleta.com'>www.boleta.com</a>";
        } 
        elseif (strpos($message, '4') !== false) {
        return "Tu Horario de clases lo puedes consultar y descargar en el siguiente link: <a href='www.boleta.com'>www.boleta.com</a>";
        } 
        else {
            return "Lo siento, esta opcion no existe en el menu. ¿Puedes intentar de nuevo?";
        }
        */

        // Consultar todas las opciones del menú
        //$menu_opciones = Reglas::all();
        $menu_opciones = Reglas::where('tipo_respuesta', '4')->get();

        // Si el mensaje contiene 'numerocontrol', mostrar las opciones
        if (strpos($message, 'numerocontrol') !== false) {
            $response = "📌Por favor, ingresa un numero de la opción del menú para poder ayudarte con la información que me solicites:<br>";
            
            foreach ($menu_opciones as $opcion) {
                $response .= "{$opcion->numero_pregunta}️⃣. {$opcion->descripcion_pregunta} 📄<br>";
            }

            return $response;
        }

        // Buscar la opción seleccionada en el mensaje
        foreach ($menu_opciones as $opcion) {
            if (strpos($message, (string) $opcion->numero_pregunta) !== false) {
                return "{$opcion->description_respuesta} : <a href='#'>www.cotz.com</a>";
            }
        }

        // Si no se encuentra una opción válida
        return "Lo siento, esta opción no existe en el menú. ¿Puedes intentar de nuevo?";


    }
}
