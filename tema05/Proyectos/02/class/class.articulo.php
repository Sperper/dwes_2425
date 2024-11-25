<?php

    /*
        archivo:class.articulo.php
        descripcion: define la clase artículo con propiead encapsulamiento
    */

    class Class_articulo {

        private $id;
        private $descripcion;
        private $modelo;
        private $marca;
        private $categorias;
        private $unidades;
        private $precio;

        public function __construct(
            $id = null,
            $descripcion = null, 
            $modelo = null, 
            $marca = null, 
            $categorias = [], 
            $unidades = null, 
            $precio = null
            ) {
                $this->id = $id;
                $this->descripcion = $descripcion;
                $this->modelo = $modelo;
                $this->marca = $marca;
                $this->categorias = $categorias;
                $this->unidades = $unidades;
                $this->precio = $precio;
            } 

        /**
         * Get the value of id
         */
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         */
        public function setId($id): self
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of descripcion
         */
        public function getDescripcion()
        {
                return $this->descripcion;
        }

        /**
         * Set the value of descripcion
         */
        public function setDescripcion($descripcion): self
        {
                $this->descripcion = $descripcion;

                return $this;
        }

        /**
         * Get the value of modelo
         */
        public function getModelo()
        {
                return $this->modelo;
        }

        /**
         * Set the value of modelo
         */
        public function setModelo($modelo): self
        {
                $this->modelo = $modelo;

                return $this;
        }

        /**
         * Get the value of marca
         */
        public function getMarca()
        {
                return $this->marca;
        }

        /**
         * Set the value of marca
         */
        public function setMarca($marca): self
        {
                $this->marca = $marca;

                return $this;
        }

        /**
         * Get the value of categorias
         */
        public function getCategorias()
        {
                return $this->categorias;
        }

        /**
         * Set the value of categorias
         */
        public function setCategorias($categorias): self
        {
                $this->categorias = $categorias;

                return $this;
        }

        /**
         * Get the value of unidades
         */
        public function getUnidades()
        {
                return $this->unidades;
        }

        /**
         * Set the value of unidades
         */
        public function setUnidades($unidades): self
        {
                $this->unidades = $unidades;

                return $this;
        }

        /**
         * Get the value of precio
         */
        public function getPrecio()
        {
                return $this->precio;
        }

        /**
         * Set the value of precio
         */
        public function setPrecio($precio): self
        {
                $this->precio = $precio;

                return $this;
        }
    }