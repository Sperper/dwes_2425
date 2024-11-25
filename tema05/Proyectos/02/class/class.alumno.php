<?php

/*
    archivo:class.alumno.php
    nombre: define la clase alumno sin encapsulamiento
*/

class Class_alumno
{

    public $id;
    public $nombre;
    public $apellidos;
    public $email;
    public $telefono;
    public $nacionalidad;
    public $dni;
    public $fecha_nacimiento;
    public $id_curso;

    public function __construct(
        $id = null,
        $nombre = null,
        $apellidos = null,
        $email = null,
        $telefono = null,
        $nacionalidad = null,
        $dni = null,
        $fecha_nacimiento = null,
        $id_curso = null
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->telefono = $telefono;
        $this->nacionalidad = $nacionalidad;
        $this->dni = $dni;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->id_curso = $id_curso;
    }
    public function edad(){
        $fechaActual = new DateTime();   //  Fecha Actual
        $fechaNacimiento = new DateTime($this->fechaNac);   //  Fecha de nacimientos
        $edad = $fechaNacimiento->diff($fechaActual);   //dIFERENCIA ENTRE FECHAS
        return $edad->y; //  Devuelve solo los años
    }
}

