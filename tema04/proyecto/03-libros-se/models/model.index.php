<?php

    /*
        Modelo: model.index.php
        Descripción: genera array objetos de la clase libros
    */

    # Símbolo monetario local
    setlocale(LC_MONETARY,"es_ES");

    # Creo un objeto de la clase tabla libros
    $obj_tabla_libros = new Class_tabla_libros();

    # Cargo tabla de materias
    $materias = $obj_tabla_libros->getMaterias();

    # Cargo tabla de etiquetas
    $etiquetas = $obj_tabla_libros->getEtiquetas();

    # Relleno el array de objetos
    $obj_tabla_libros->getDatos();

    # Obtener tabla de libros sin encapsulamiento
    $array_libros = $obj_tabla_libros->tabla;

