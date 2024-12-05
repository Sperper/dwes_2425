<?php

    /*
        Modelo: model.nuevo.php
        Descripción: genera los datos necesarios para añadir nuevo corredor
    */

    # Símbolo monetario local
    setlocale(LC_MONETARY,"es_ES");

    # Creo un objeto de la clase tabla alumnos
    $corredores = new Class_tabla_corredores();
    
    # Cargo tabla de categorías
    $categorias = $corredores->getCategorias();

    # Cargo tabla de cursos
    $clubs = $corredores->getClubs();

    