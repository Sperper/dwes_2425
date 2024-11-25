<?php

/*
    archivo: class.calculadora.php
    descripcion: define clase calculadora con propiedad encapsulamiento
        - Propiedades: valor1, valor2, operador, resultado
        - Metodos: suma(), resta(), division(), multiplicacion(), potencia()
*/

class Class_calculadora
{

    # Atributos o propiedades
    private $valor1;
    private $valor2;
    private $operador;
    private $resultado;

    # Constructor
    public function __construct()
    {
        $this->valor1 = 0;
        $this->valor2 = 0;
        $this->operador = null;
        $this->resultado = 0;
    }
    # Metodo suma()
    public function suma()
    {
        $this->operador = '+';
        $this->resultado = $this->valor1 + $this->valor2;
    }

    # Metodo resta()
    public function resta()
    {
        $this->operador = '-';
        $this->resultado = $this->valor1 - $this->valor2;
    }

    # Metodo division()
    public function division()
    {
        $this->operador = '/';
        $this->resultado = $this->valor1 / $this->valor2;
    }

    # Metodo multiplicacion()
    public function multiplicacion()
    {
        $this->operador = '*';
        $this->resultado = $this->valor1 * $this->valor2;
    }

    # Método potencia()
    public function potencia()
    {
        $this->operador = '^';
        $this->resultado = pow($this->valor1, $this->valor2);
    }
}
