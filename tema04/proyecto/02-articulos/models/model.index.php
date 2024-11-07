<?php

    /*
        Modelo: model.index.php
        Descripción: genera array objetos de la clase artículos
    */

    # Símbolo monetario local
    setlocale(LC_MONETARY,"es_ES");

    # Creo un objeto de la clase tabla artículos
    $obj_tabla_articulos = new Class_tabla_articulos();

    # Cargo tabla de marcas
    $marcas = $obj_tabla_articulos->getMarcas();

    # Cargo tabla de categorías
    $categorias = $obj_tabla_articulos->getCategorias();

    # Relleno el array de objetos
    $obj_tabla_articulos->getDatos();

    # Obtener tabla de artículos
    $array_articulos = $obj_tabla_articulos->getTabla();

