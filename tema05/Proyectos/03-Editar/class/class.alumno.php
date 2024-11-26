<?php

/*
    archivo:class.alumno.php
    titulo: define la clase alumno sin encapsulamiento
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
    public $fechaNac;
    public $id_curso;

    public function __construct(
        $id = null,
        $nombre = null,
        $apellidos = null,
        $email = null,
        $telefono = null,
        $nacionalidad = null,
        $dni = null,
        $fechaNac = null,
        $id_curso = null
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->telefono = $telefono;
        $this->nacionalidad = $nacionalidad;
        $this->dni = $dni;
        $this->fechaNac = $fechaNac;
        $this->id_curso = $id_curso;
    }

    public function edad()
    {
        $fechaActual = new DateTime(); // Fecha actual
        $fechaNacimiento = new DateTime($this->fechaNac); // Fecha de nacimiento
        $edad = $fechaNacimiento->diff($fechaActual); // Diferencia entre las fechas
        return $edad->y; // Devuelve solo los años

    }
}

