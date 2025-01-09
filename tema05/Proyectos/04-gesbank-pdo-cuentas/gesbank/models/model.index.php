<?php

    /*
        Modelo: model.index.php
        Descripción: muestra los detalles de cuentas

    */

    # Símbolo monetario local
    setlocale(LC_MONETARY,"es_ES");

    # Creo un objeto de la clase tabla cuentas
    $conexion = new Class_tabla_cuentas();

    # Obtengo un objeto de la clase pdostatement con los detalles de cuentas
    $stmt_cuentas = $conexion->getCuentas();

    
