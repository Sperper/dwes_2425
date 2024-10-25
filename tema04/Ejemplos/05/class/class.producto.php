<?php
class Class_producto {   
    protected $id;    
    protected $titulo;   
    protected $precio;   
    protected $nombreAutor;   
    protected $apellidosAutor;   
    
    function __construct( 
     $id=null,  
     $titulo=null, 
     $precio=null, 
     $nombreAutor=null, 
     $apellidosAutor=null 
    ) {   
          $this->id = $id;   
          $this->titulo= $titulo;   
          $this->nombreAutor = $nombreAutor;   
          $this->apellidosAutor = $apellidosAutor;   
          $this->precio = $precio;   
    }   

    
}
class Class_libro extends Class_producto
{
    private $numPaginas;
    function __construct(
        $id = null,
        $titulo = null,
        $precio = null,
        $nombreAutor = null,
        $apellidosAutor = null,
        $numPaginas = null
    ) {
        parent::__construct(
            $id,
            $titulo,
            $precio,
            $nombreAutor,
            $apellidosAutor
        );
        $this->numPaginas = $numPaginas;
    }
    public function getNumPaginas()
    {
        return $this->numPaginas;
    }
    public function getResumen()
    {
        $resumen = "Titulo: " . $this->getTitulo() . ", Precio: " .
            $this->getPrecio();
        $resumen .= ", Autor: " . $this->getAutor() . ", Núm.
     páginas: " . $this->getNumPaginas();
        return $resumen;
    }
}