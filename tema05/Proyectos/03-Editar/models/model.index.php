<?php

    /*
        Modelo: model.index.php
        Descripción: muestra los alumnos

    */

    # Símbolo monetario local
    setlocale(LC_MONETARY,"es_ES");

    # Creo un objeto de la clase tabla alumnos
    $tabla_alumnos = new Class_tabla_alumnos(
            'localhost',
            'root',
            '',
            'fp' );

    # Cargo tabla de alumnos
    $alumnos = $tabla_alumnos->getAlumnos();

    
