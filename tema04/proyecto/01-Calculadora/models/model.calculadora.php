<?php 

    $valor1 = $_GET['valor1'];

    $valor2 = $_GET['valor2'];

    $operador = $_GET['operador'];

    $calc = new Class_calculadora(
        $valor1,
        $valor2,
        $operador
    );

    # evalulo la operacion 

    switch ($operacion) {
        case 'sumar': $calc->suma(); break;
        case 'restar': $calc->resta(); break;
        case 'multiplicar': $calc->multiplicacion(); break;
        case 'dividir': $calc->division(); break;
        default: echo 'Introduce una operacion valido';
    }

