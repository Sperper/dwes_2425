<?php

    /*
        Creamos una clase para cada tabla
        las propiedades públicas y una propiedad para cada columna

        No respetará la propiedad de encapsulamiento.
    */

    class classLibro {

        public $id;
        public $titulo;
        public $precio;
        public $stock;
        public $fecha_edicion;
        public $isbn;
        public $autor_id;
        public $editorial_id;
        public $generos_id;
        
        public function __construct(
            $id = null,
            $titulo = null,
            $precio = null,
            $stock = null,
            $fecha_edicion = null,
            $isbn = null,
            $autor_id = null,
            $editorial_id = null,
            $generos_id = null
        ) {
            $this->id = $id;
            $this->titulo = $titulo;
            $this->precio = $precio;
            $this->stock = $stock;
            $this->fecha_edicion = $fecha_edicion;
            $this->isbn = $isbn;
            $this->autor_id = $autor_id;
            $this->editorial_id = $editorial_id;
            $this->generos_id = $generos_id;
        }

        public function edad(){
            $fechaNacimiento = new DateTime($this->fechaNac);
            $hoy = new DateTime();
            $edad = $hoy->diff($fechaNacimiento)->y;
            return $edad;
        }

        
    }