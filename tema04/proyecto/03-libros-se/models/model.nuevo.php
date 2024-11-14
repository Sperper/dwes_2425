<?php

    /*
        Modelo: model.nuevo.php
        Descripción: genera los datos necesarios para añadir nuevo libro
    */

    # Símbolo monetario local
    setlocale(LC_MONETARY,"es_ES");

    # Creo un objeto de la clase tabla libros
    $obj_tabla_libros = new Class_tabla_libros();

    # Cargo tabla de materias
    $materias = $obj_tabla_libros->getMaterias();

    # Cargo tabla de etiquetas
    $etiquetas = $obj_tabla_libros->getEtiquetas();

    

