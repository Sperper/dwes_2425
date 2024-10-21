<?php
    /*
        Modelo: model.show.php
        Descripción: Muestra formulario con los detalles no editables de un alumno

        Método GET:
            - id alumno que se desea mostrar
    */

    # Cargo id del alumno que voy a editar
    $id = $_GET['id'];

    # Cargar la tabla de alumnos
    $alumnos = get_tabla_alumnos();

    # Buscar id en la tabla alumnos y devuelvo índice.
    $indice_mostrar = buscar_tabla_2($alumnos, 'id', $id);

    # Validar la búsqueda
    if ($indice_mostrar === false) {
        
        echo "ERROR: alumno no encontrado";
        exit();

    } 

    # Creo el array registro sólo con los detalles del alumno
    $registro = $alumnos[$indice_mostrar];


    
