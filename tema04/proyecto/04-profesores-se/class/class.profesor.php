<?php

    /* 
        Nombre: class.profesor.php
        Descripcion: Define la clase profesores sin encapsulamiento
    */

    class Class_profesor {

        public $id;
        public $nombre;
        public $apellidos;
        public $nrp;
        public $fecha_nacimiento;
        public $poblacion;
        public $especialidad;
        public $asignaturas;

        public function __construct(
            $id,
            $nombre,
            $apellidos,
            $nrp,
            $fecha_nacimiento,
            $poblacion,
            $especialidad,
            $asignaturas
        ) {
            $this->id = $id;
            $this->nombre = $nombre;
            $this->apellidos = $apellidos;
            $this->nrp = $nrp;
            $this->fecha_nacimiento = $fecha_nacimiento;
            $this->poblacion = $poblacion;
            $this->especialidad = $especialidad;
            $this->asignaturas = $asignaturas;
        }

    }

