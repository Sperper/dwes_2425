<?php

    /*
        Modelo: model.ordenar.php
        Descripción: ordena los alumnos por algún criterio

        Parámetros:
            - criterio: el número que identifica la posición de la columna en
            la tabla alumnos
    */

    # Símbolo monetario local
    setlocale(LC_MONETARY,"es_ES");

    # Obtener el criterio de ordenación
    $criterio = $_GET['criterio'];

    # Creo un objeto de la clase tabla alumnos
    $tabla_alumnos = new Class_tabla_alumnos();

    # Ejecuto el  método order() y devuelve objeto de la clase
    # mysqli_result
    $alumnos = $tabla_alumnos->order($criterio);

    
