<?php

    /*
        Modelo: model.index.php
        Descripción: genera array objetos de la clase profesor
    */

    # Símbolo monetario local
    setlocale(LC_MONETARY,"es_ES");

    # Creo un objeto de la clase tabla_profesores
    $obj_tabla_preofesores = new Class_tabla_profesores();

    # Genero el array de Especialidades
    $especialidades = $obj_tabla_preofesores->getEspecialidad();

    # Genero el array de asignaturas
    $asignaturas =  $obj_tabla_preofesores->getAsignaturas();

    # Relleno el array de objetos


