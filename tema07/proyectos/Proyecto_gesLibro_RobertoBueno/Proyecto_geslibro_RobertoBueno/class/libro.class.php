<?php

    /*
        Creamos una clase para cada tabla
        las propiedades públicas y una propiedad para cada columna

        No respetará la propiedad de encapsulamiento.
    */

    class classLibro {

        public $id;
        public $titulo;
        public $autor_id;
        public $editorial_id;
        public $precio;
        public $stock;
        public $fecha_edicion;
        public $isbn;
        public $generos_id;
        

        public function __construct(
            $id = null,
            $titulo = null,
            $autor_id = null,
            $editorial_id = null,
            $precio = null,
            $unidades = null,
            $fecha_edicion = null,
            $isbn = null,
            $generos_id = []
            ) {
                $this->id = $id;
                $this->titulo = $titulo;
                $this->autor_id = $autor_id;
                $this->editorial_id = $editorial_id;
                $this->precio = $precio;
                $this->unidades = $unidades;
                $this->fecha_edicion = $fecha_edicion;
                $this->isbn = $isbn;
                $this->generos_id = $generos_id;
            } 


        
    }