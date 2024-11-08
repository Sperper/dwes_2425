<?php

    /*
        Modelo: model.nuevo.php
        Descripción: genera los datos necesarios para añadir nuevo artículo
    */

    # Símbolo monetario local
    setlocale(LC_MONETARY,"es_ES");

    # Creo un objeto de la clase tabla artículos
    $obj_tabla_articulos = new Class_tabla_articulos();

    # Cargo tabla de marcas
    $marcas = $obj_tabla_articulos->getMarcas();

    # Cargo tabla de categorías
    $categorias = $obj_tabla_articulos->getCategorias();

    

