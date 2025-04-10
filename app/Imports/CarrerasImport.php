<?php

namespace App\Imports;

use App\Models\Carreras;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
// esto es para mensajes de validacion
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Facades\Validator;
// hasta aqui para mensajes de validacion
use Carbon\Carbon;


class CarrerasImport implements ToModel, WithHeadingRow, WithValidation, WithBatchInserts, WithChunkReading
{
    /**
    * @param Collection $collection
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


        $nombre_carrera = $row['nombre_carrera'];

        // Verificar si ya existe un alumno con esa matrícula
        $nombre_carrera = Carreras::where('nombre_carrera', $nombre_carrera)->first();

        // Si ya existe, actualizamos los datos; si no, creamos uno nuevo
        if ($nombre_carrera) {
            // Actualizar el registro existente
            $nombre_carrera->update([
                'nombre_carrera' => $row['nombre_carrera'],
            ]);
            
            //return null; // Retorna null para evitar la inserción de un nuevo registro
        
            // Contador de registros actualizados
            $this->updatedCount++;        
        
        } else {
            // Si no existe, creamos un nuevo alumno        
        return new Carreras([
            //
            'nombre_carrera' => $row['nombre_carrera'],
        ]);

         // Contador de registros insertados
         $this->insertedCount++;

        } 
    }

    public function rules(): array
    {
        return [
            //'nombre'            => 'required|string',
            'nombre_carrera'        => 'required',
        ];
    } 

    // Personalizar los mensajes de error para cada campo
    public function customValidationMessages()
    {
        return [
            'nombre_carrera.required'  => 'El campo nombre_carrera es obligatorio y no debe de ir vacio',
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
