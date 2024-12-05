<?php

    /*
        Modelo: model.ordenar.php
        Descripción: ordena los clientes por algún criterio

        Parámetros:
            - criterio: el número que identifica la posición de la columna en
            la tabla clientes
    */

    # Símbolo monetario local
    setlocale(LC_MONETARY,"es_ES");

    # Obtener el criterio de ordenación
    $criterio = $_GET['criterio'];

    # Creo un objeto de la clase tabla clientes
    $conexion = new Class_tabla_clientes();

    # Ejecuto el  método order() y devuelve objeto de la clase
    # mysqli_result
    $stmt_clientes = $conexion->order($criterio);

    
