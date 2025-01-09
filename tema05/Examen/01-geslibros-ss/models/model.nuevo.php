<?php

    /*
        Modelo: model.nuevo.php
        Descripción: genera los datos necesarios para añadir nuevo cliente
    */

    $conexion = new Class_tabla_libros();

    $editoriales = $conexion->get_editoriales();

    $autores = $conexion->get_autores();

    $generos = $conexion->get_generos();

