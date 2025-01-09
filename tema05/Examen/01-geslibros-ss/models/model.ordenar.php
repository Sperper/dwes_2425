<?php

    /*
        Modelo: model.ordenar.php
        Descripción: ordena los clientes por algún criterio

        Parámetros:
            - criterio: el número que identifica la posición de la columna en
              en el select de getClientes()
    */

    $criterio = $_GET['criterio'];

    $conexion = new Class_tabla_libros();

    $stmt_libros = $conexion->order($criterio);