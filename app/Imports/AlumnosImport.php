<?php

namespace App\Imports;

use App\Models\Alumnos;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
// esto es para mensajes de validacion
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Facades\Validator;
// hasta aqui para mensajes de validacion
use Carbon\Carbon;

//class AlumnosImport implements ToModel
class AlumnosImport implements ToModel, WithHeadingRow, WithValidation, WithBatchInserts, WithChunkReading
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


        $matricula = $row['matricula'];

        $fechaNacimiento = $row['fecha_nacimiento'];
        $fechaIngreso = $row['fecha_ingreso'];
        
        $fechaNacimiento = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($fechaNacimiento))->format('Y-m-d');
        $fechaIngreso = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($fechaIngreso))->format('Y-m-d');
        
        // Depuración de las fechas convertidas
        //dd($fechaNacimiento, $fechaIngreso);

        // Verificar si ya existe un alumno con esa matrícula
        $alumno = Alumnos::where('matricula', $matricula)->first();

        // Si ya existe, actualizamos los datos; si no, creamos uno nuevo
        if ($alumno) {
            // Actualizar el registro existente
            $alumno->update([
                'nombre'           => $row['nombre'],
                'apellido_paterno' => $row['apellido_paterno'],
                'apellido_materno' => $row['apellido_materno'],
                'fecha_nacimiento'  => $fechaNacimiento,
                'sexo'             => $row['sexo'],
                'correo_electronico' => $row['correo_electronico'],
                'telefono'         => $row['telefono'],
                'direccion'        => $row['direccion'],
                'fecha_ingreso'     => $fechaIngreso,
                'estado'           => $row['estado'],
                'carrera'          => $row['carrera'],
                'semestre'         => $row['semestre'],
                'estatus'          => $row['estatus'],
            ]);
            
            //return null; // Retorna null para evitar la inserción de un nuevo registro
        
            // Contador de registros actualizados
            $this->updatedCount++;        
        
        } else {
            // Si no existe, creamos un nuevo alumno        
        return new Alumnos([
            //
            'nombre'            => $row['nombre'],
            'apellido_paterno'  => $row['apellido_paterno'],
            'apellido_materno'  => $row['apellido_materno'],
            //'fecha_nacimiento'  => Carbon::parse($row['fecha_nacimiento']),
            'fecha_nacimiento'  => $fechaNacimiento,
            'sexo'              => $row['sexo'],
            'correo_electronico'=> $row['correo_electronico'],
            'telefono'          => $row['telefono'],
            'direccion'         => $row['direccion'],
            'matricula'         => $row['matricula'],
            //'fecha_ingreso'     => Carbon::parse($row['fecha_ingreso']),
            'fecha_ingreso'     => $fechaIngreso,
            'estado'            => $row['estado'],
            'carrera'           => $row['carrera'],
            'semestre'          => $row['semestre'],
            'estatus'           => $row['estatus'],            
        ]);

         // Contador de registros insertados
         $this->insertedCount++;

        } 
    }

    public function rules(): array
    {
        return [
            //'nombre'            => 'required|string',
            'nombre'            => 'required',
            'apellido_paterno'  => 'required',
            'apellido_materno'  => 'required',
            'fecha_nacimiento'  => 'required',
            'sexo'              => 'required',
            'correo_electronico'=> 'required',
            'telefono'          => 'required',
            'direccion'         => 'required',
            'matricula'         => 'required',
            'fecha_ingreso'     => 'required',
            'estado'            => 'required',
            'carrera'           => 'required',
            'semestre'          => 'required',
            'estatus'           => 'required',
        ];
    } 

    // Personalizar los mensajes de error para cada campo
    public function customValidationMessages()
    {
        return [
            'nombre.required'            => 'El campo nombre es obligatorio y no debe de ir vacio',
            'apellido_paterno.required'  => 'El campo apellido paterno es obligatorio y no debe de ir vacio',
            'apellido_materno.required'  => 'El campo apellido materno es obligatorio y no debe de ir vacio',
            'fecha_nacimiento.required'  => 'El campo fecha de nacimiento es obligatorio y no debe de ir vacio',
            'sexo.required'              => 'El campo sexo es obligatorio y no debe de ir vacio',
            'correo_electronico.required'=> 'El campo correo electrónico es obligatorio y no debe de ir vacio',
            'telefono.required'               => 'El campo teléfono es obligatorio y no debe de ir vacio',
            'matricula.required'         => 'El campo matrícula es obligatorio y no debe de ir vacio',
            'fecha_ingreso.required'     => 'El campo fecha de ingreso es obligatorio y no debe de ir vacio',
            'estado.required'            => 'El campo estado es obligatorio y no debe de ir vacio',
            'carrera.required'           => 'El campo carrera es obligatorio y no debe de ir vacio',
            'semestre.required'          => 'El campo semestre es obligatorio y no debe de ir vacio',
            'estatus.required'           => 'El campo estatus es obligatorio y no debe de ir vacio',
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
