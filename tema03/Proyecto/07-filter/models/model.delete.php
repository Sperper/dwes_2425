<?php

    /*
        Modelo: model.delete.php
        Descripción: Elimina un elemento de la lista

        Método GET:
            - id alumno que se desea eliminar
    */

    # Cargo id 
    $id = $_GET['id'];

    # Cargar la tabla de alumnos
    $alumnos = get_tabla_alumnos();

    # Buscar id en la tabla alumnos y devuelvo índice.
    $indice_eliminar = buscar_tabla_2($alumnos, 'id', $id);

    # Validar la búsqueda
    if ($indice_eliminar !== false) {
        
        // Eliminar Alumno
        unset($alumnos[$indice_eliminar]);

    } else {
        
        echo "ERROR: alumno no encontrado";
        exit();
    }

    
