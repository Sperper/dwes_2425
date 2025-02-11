<?php

    /*
        Creamos una clase para cada tabla
        las propiedades públicas y una propiedad para cada columna

        No respetará la propiedad de encapsulamiento.
    */

    class classAlbum {

        public $id;
        public $titulo;
        public $descripcion;
        public $autor;
        public $fecha;
        public $lugar;
        public $num_fotos;
        public $num_visitas;
        public $carpeta;
        public $categoria_id;

        public function __construct(
            $id     = null,
            $titulo = null,
            $descripcion= null,
            $autor= null,
            $fecha= null,
            $lugar= null,
            $carpeta= null,
            $num_fotos= null,
            $num_visitas= null,
            $categoria_id= null

        ) {
            $this->id = $id;
            $this->titulo = $titulo;
            $this->descripcion = $descripcion;
            $this->autor = $autor;
            $this->fecha = $fecha;
            $this->lugar = $lugar;
            $this->num_fotos = $num_fotos;
            $this->num_visitas = $num_visitas;
            $this->carpeta = $carpeta;
            $this->categoria_id = $categoria_id;
        }

        

        
    }