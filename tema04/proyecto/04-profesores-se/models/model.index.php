<?php

    /*
        Modelo: model.index.php
        Descripción: genera array objetos de la clase profesor
    */

    # Símbolo monetario local
    setlocale(LC_MONETARY,"es_ES");

    # Creo un objeto de la clase tabla_profesores
    $obj_tabla_profesores = new Class_tabla_profesores();

    # Genero el array de Especialidades
    $especialidades = $obj_tabla_profesores->getEspecialidad();

    # Genero el array de asignaturas
    $asignaturas =  $obj_tabla_profesores->getAsignaturas();

    # getDatos
    $obj_tabla_profesores->getDatos();

    # Relleno el array de objetos
    $array_profesores = $obj_tabla_profesores->tabla;

