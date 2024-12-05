<?php

    /*
        Modelo: model.filtrar.php
        Descripción: muestra los alumnos que contienen el patrón de búsqueda. 
                     el registro seleccionado debe contener dicha expresión en cualquiera de los campos

        Parámetros:
            - expresion: patrón de búsqueda
            
    */

    # Símbolo monetario local
    setlocale(LC_MONETARY,"es_ES");

    # Obtener el criterio de ordenación
    $expresion = $_GET['expresion'];

    # Creo un objeto de la clase tabla alumnos
    $tabla_alumnos = new Class_tabla_alumnos();

    # Ejecuto el  método filter() y devuelve objeto de la clase
    # mysqli_result
    $alumnos = $tabla_alumnos->filter($expresion);

    
