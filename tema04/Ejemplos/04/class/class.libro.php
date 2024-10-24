<?php

    class Class_libro {

        private $id;
        private $titulo;
        private $precio;
        private $paginas;
        private $autor;
        private $tematica;

        public function __construct(
            $id = null,
            $titulo = null,
            $precio = 0,
            $paginas = 0,
            $autor = null,
            $tematica = []
        ){
            $this->id = null;
            $this->titulo = null;
            $this->precio = 0;
            $this->paginas = 0;
            $this->autor = null;
            $this->tematica = [];
        }

        


    }