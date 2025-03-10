<?php

/*
    Creamos una clase para cada tabla
    las propiedades públicas y una propiedad para cada columna

    No respetará la propiedad de encapsulamiento.
*/

class classUsuario {

    public $id;
    public $name;
    public $email;
    public $password;

    public function __construct(
        $id = null,
        $name = null,
        $email = null,
        $password = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    
}
