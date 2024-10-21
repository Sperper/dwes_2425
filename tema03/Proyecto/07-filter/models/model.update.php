<?php

    /*

        Modelo:  model.update.php
        Descripción: actauliza los detalles de un alumno

        Método POST:
            - id
            - nombre
            - poblacion
            - curso
        
        Metodo GET:
            - id
    */

    # Extraemos los valores del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $poblacion = $_POST['poblacion'];
    $curso = $_POST['curso'];

    #  Extraemos el id del alumno
    $id_editar = $_GET['id'];

    # Cargo la tabla alumnos
    $alumnos = get_tabla_alumnos();

    # Obtenemos el índice de la tabla donde se encuentra ese alumno
    $indice_editar = buscar_tabla_2($alumnos, 'id', $id_editar);

    # Creo un array asociativo con los detalles actualizados del alumno
    $registro = [
        'id' => $id,
        'nombre' => $nombre,
        'poblacion' => $poblacion,
        'curso' => $curso
    ];

   

    # Actualizo la tabla alumnos
    $alumnos[$indice_editar] = $registro;


