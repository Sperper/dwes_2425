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
    $obj_tabla_libros = new Class_tabla_libros();

    #  Cargo los datos de artículos
    $obj_tabla_libros->getDatos();
    
    # Cargo el array de marcas - lista desplegable dinámica
    $materias = $obj_tabla_libros->getMaterias();

    # Obtener el objeto de la clase artículo correspondiente a ese índice
    $obj_tabla_libros->delete($indice);

    # Obtengo la tabla de artículos actualizada para la vista
    $array_libros = $obj_tabla_libros->tabla;