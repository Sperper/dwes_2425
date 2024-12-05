<?php

    /*
        Modelo: model.index.php
        Descripción: muestra los detalles de clientes

    */

    # Símbolo monetario local
    setlocale(LC_MONETARY,"es_ES");

    # Creo un objeto de la clase tabla clientes
    $conexion = new Class_tabla_clientes();

    # Obtengo un objeto de la clase pdostatement con los detalles de clientes
    $stmt_clientes = $conexion->getClientes();

    
