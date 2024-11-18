<?php

    /*
        Nombre: model.nuevo.php 
        Descripcion: Carga el array de especialidades y de asignaturas
    */

    # Creo el objeto de la clase class_tabla_profesores
    $obj_tabla_profesores = new Class_tabla_profesores();

    # Cargo el array de especialidades
    $especialidades = $obj_tabla_profesores->getEspecialidad();

    # Cargo el array de asignaturas
    $asignaturas = $obj_tabla_profesores->getAsignaturas();