<?php

    /*
        archivo:class.libor.php
        titulo: define la clase libro sin encapsulamiento
    */

    class Class_libro {

        public $id;
        public $titulo;
        public $autor;
        public $editorial;
        public $fecha_edicion;
        public $materia;
        public $etiquetas;
        public $precio;

        public function __construct(
            $id = null,
            $titulo = null, 
            $autor = null, 
            $editorial = null, 
            $fecha_edicion = null, 
            $materia = null,
            $etiquetas = [], 
            $precio = null
            ) {
                $this->id = $id;
                $this->titulo = $titulo;
                $this->autor = $autor;
                $this->editorial = $editorial;
                $this->fecha_edicion = $fecha_edicion;
                $this->materia = $materia;
                $this->etiquetas = $etiquetas;
                $this->precio = $precio;
            } 
        }

       