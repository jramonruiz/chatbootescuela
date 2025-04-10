<?php

namespace App\Imports;

use App\Models\Alumnos;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Carbon\Carbon;

//class AlumnosImport implements ToModel
class AlumnosImport implements ToModel, WithHeadingRow//, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //dd($row);

        $fechaNacimiento = $row['fecha_nacimiento'];
        $fechaIngreso = $row['fecha_ingreso'];
        //$fechaNacimiento = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha_nacimiento']));
        //$fechaIngreso = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha_ingreso']));
        
        //$fechaNacimiento = \Carbon\Carbon::parse($row['fecha_nacimiento']);
        //$fechaIngreso = \Carbon\Carbon::parse($row['fecha_ingreso']);
        
        $fechaNacimiento = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($fechaNacimiento))->format('Y-m-d');
        $fechaIngreso = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($fechaIngreso))->format('Y-m-d');
        
        // Depuración de las fechas convertidas
        //dd($fechaNacimiento, $fechaIngreso);

        // Validar si la matrícula ya existe
    $matriculaExistente = Alumnos::where('matricula', $row['matricula'])->first();

    if ($matriculaExistente) {
        // Si existe un alumno con la misma matrícula, lanzamos un error
        throw new \Exception("El alumno con matrícula {$row['matricula']} ya existe en la base de datos.");
    }
        
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
    }

    public function rules(): array
    {
        return [
            'nombre'            => 'required|string',
            'apellido_paterno'  => 'required|string',
            'apellido_materno'  => 'required|string',
            'fecha_nacimiento'  => 'required|date',
            'sexo'              => 'required|string',
            'correo_electronico'=> 'required|email',
            'telefono'          => 'required|string',
            'direccion'         => 'required|string',
            'matricula'         => 'required|string',
            'fecha_ingreso'     => 'required|date',
            'estado'            => 'required|string',
            'carrera'           => 'required|string',
            'semestre'          => 'required|string',
            'estatus'           => 'required|string',
        ];
    } 
    
    public function headingRow(): int
    {
        return 1; // Indica que la primera fila son los encabezados
    }
}
