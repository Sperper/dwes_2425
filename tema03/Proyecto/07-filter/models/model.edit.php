<?php
    /*
        Modelo: model.edit.php
        Descripción: Muestra formulario con los detalles editables de un alumno

        Método GET:
            - id alumno que se desea editar
    */

    # Cargo id del alumno que voy a editar
    $id = $_GET['id'];

    # Cargar la tabla de alumnos
    $alumnos = get_tabla_alumnos();

    # Buscar id en la tabla alumnos y devuelvo índice.
    $indice_editar = buscar_tabla_2($alumnos, 'id', $id);

    # Validar la búsqueda
    if ($indice_editar === false) {
        
        echo "ERROR: alumno no encontrado";
        exit();

    } 

    # Creo el array registro sólo con los detalles del alumno
    $registro = $alumnos[$indice_editar];


    
