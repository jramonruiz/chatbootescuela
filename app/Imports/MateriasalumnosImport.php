<?php

namespace App\Imports;

use App\Models\Materias_alumnos;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
// esto es para mensajes de validacion
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Facades\Validator;
// hasta aqui para mensajes de validacion
use Carbon\Carbon;


class MateriasalumnosImport implements ToModel, WithHeadingRow, WithValidation, WithBatchInserts, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    protected $insertedCount = 0;
    protected $updatedCount = 0;
    protected $totalregistros = 0;

    public function model(array $row)
    {
        $this->totalregistros++;
        //dd($row);

        // Agregar log para depuración
        \Log::info('Fila procesada:', $row);  // Esto te permitirá ver qué datos están siendo procesados.


        $clave_materia = $row['clave_materia'];

        // Verificar si ya existe un alumno con esa matrícula
        $materiasalumnos = Materias_alumnos::where('clave_materia', $clave_materia)->first();

        // Si ya existe, actualizamos los datos; si no, creamos uno nuevo
        if ($materiasalumnos) {
            // Actualizar el registro existente
            $materiasalumnos->update([
                'clave_materia'           => $row['clave_materia'],
                'nombre_materia' => $row['nombre_materia'],
                'descripcion_materia' => $row['descripcion_materia'],
                'creditos'             => $row['creditos'],
                'carrera'          => $row['carrera'],
                'semestre'         => $row['semestre'],
            ]);
            
            //return null; // Retorna null para evitar la inserción de un nuevo registro
        
            // Contador de registros actualizados
            $this->updatedCount++;        
        
        } else {
            // Si no existe, creamos un nuevo alumno        
        return new Materias_alumnos([
            //
            'clave_materia'           => $row['clave_materia'],
            'nombre_materia' => $row['nombre_materia'],
            'descripcion_materia' => $row['descripcion_materia'],
            'creditos'             => $row['creditos'],
            'carrera'          => $row['carrera'],
            'semestre'         => $row['semestre'],
        ]);

         // Contador de registros insertados
         $this->insertedCount++;

        } 
    }

    public function rules(): array
    {
        return [
            //'nombre'            => 'required|string',
            'clave_materia'         => 'required',
            'nombre_materia'        => 'required',
            'descripcion_materia'   => 'required',
            'creditos'              => 'required',
            'carrera'               => 'required',
            'semestre'              => 'required',
        ];
    } 

    // Personalizar los mensajes de error para cada campo
    public function customValidationMessages()
    {
        return [
            'clave_materia.required'            => 'El campo clave_materia es obligatorio y no debe de ir vacio',
            'nombre_materia.required'  => 'El campo nombre_materia es obligatorio y no debe de ir vacio',
            'descripcion_materia.required'  => 'El campo descripcion_materia es obligatorio y no debe de ir vacio',
            'creditos.required'  => 'El campo creditos es obligatorio y no debe de ir vacio',
            'carrera.required'           => 'El campo carrera es obligatorio y no debe de ir vacio',
            'semestre.required'          => 'El campo semestre es obligatorio y no debe de ir vacio',
        ];
    }   
    
    /*
    // Usar el método withValidator para aplicar los mensajes personalizados
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Personalizar los mensajes de validación si es necesario
            foreach ($this->customValidationMessages() as $key => $message) {
                $validator->addCustomMessages([$key => $message]);
            }
        });
    } 
    */   
    
    public function headingRow(): int
    {
        return 1; // Indica que la primera fila son los encabezados
    }

    // Puedes implementar los siguientes métodos si necesitas optimizar la importación
    public function batchSize(): int
    {
        return 1000; // Número de registros por lote
    }

    public function chunkSize(): int
    {
        return 1000; // Tamaño de cada "chunk" de registros procesados
    }    

    // Métodos para acceder a los contadores
    public function getInsertedCount()
    {
        return $this->insertedCount;
    }

    public function getUpdatedCount()
    {
        return $this->updatedCount;
    }

    public function gettotalregistros()
    {
        return $this->totalregistros;
    }

}
