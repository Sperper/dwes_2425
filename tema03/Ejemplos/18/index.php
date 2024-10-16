<?php

    /*
        funciones y procedimientos
    */

    function sumar (int $valor1, int $valor2) {
        $resultado = $valor1 + $valor2;
        return $resultado;
    };

    function producto ($valor1, &$valor2) {
        $resultado = $valor1 * $valor2;
        $valor2 = 7;
        return $resultado;
    };

    $v1 = 5;
    $v2 = 4;


    $calculo = producto ($v1, $v2);
    echo $calculo;
    echo "<BR>";
    echo $v2;
