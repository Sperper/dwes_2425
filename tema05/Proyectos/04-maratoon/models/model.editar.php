<?php

    /*
        modelo: model.editar.php
        descripción: carga los datos del corredor que deseo actualizar

        Método GET:

            - id del corredor
    */

    # Cargamos el id del alumno que vamos a editar
    $id = $_GET['id'];

    # Creo un objeto de la clase tabla alumnos
    $tabla_corredores = new Class_tabla_corredores();

    # Cargo tabla de categorías
    $categorias = $tabla_corredores->getCorredores();

    # Cargo tabla de cursos
    $clubs = $tabla_corredores->getClubs();

    # Obtener los detalles del corredor 
    // objeto de la clase corredor
    $corredor = $tabla_corredores->read($id);