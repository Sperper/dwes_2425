<?php

    /*
        modelo: model.eliminar.php
        descripción: elimina un artículo de la tabla
        
        Método GET:

            - indice: de la tabla donde se encuentra el artículo que voy a eliminar
    */

    # Cargamos el indice del artículo
    $indice = $_GET['indice'];

    # Creo un objeto de la clase tabla de artículos
    $obj_tabla_articulos = new Class_tabla_articulos();

    #  Cargo los datos de artículos
    $obj_tabla_articulos->getDatos();
    
    # Cargo el array de marcas - lista desplegable dinámica
    $marcas = $obj_tabla_articulos->getMarcas();

    # Obtener el objeto de la clase artículo correspondiente a ese índice
    $obj_tabla_articulos->delete($indice);

    # Obtengo la tabla de artículos actualizada para la vista
    $array_articulos = $obj_tabla_articulos->getTabla();