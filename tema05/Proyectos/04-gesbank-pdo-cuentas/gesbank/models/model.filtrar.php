<?php

    /*
        Modelo: model.filtrar.php
        Descripción: muestra las cuentas que contienen el patrón de búsqueda. 
                     el registro seleccionado debe contener dicha expresión en cualquiera de los campos

        Parámetros:
            - expresion: patrón de búsqueda
            
    */

    # Símbolo monetario local
    setlocale(LC_MONETARY,"es_ES");

    # Obtener el criterio de ordenación
    $expresion = $_GET['expresion'];

    # Conecto con gesbank
    $conexion = new Class_tabla_cuentas();

    # Ejecuto el  método filter() y devuelve objeto PDOStatement
    $stmt_cuentas = $conexion->filter($expresion);

    
