<?php

    /*

        Modelo:  model.create.php
        Descripción: añade un nuevo alumno a la taba

        Método POST:
            - id
            - nombre
            - poblacion
            - curso
    */

    # Extraemos los valores del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $poblacion = $_POST['poblacion'];
    $curso = $_POST['curso'];

    # Cargar tabla alumnos
    $alumnos = get_tabla_alumnos();

    # Creo un array asociativo con los detalles del nuevo alumno
    $registro = [
        'id' => $id,
        'nombre' => $nombre,
        'poblacion' => $poblacion,
        'curso' => $curso
    ];

    # Añadir nuevo alumno a la tabla
    $alumnos[] = $registro;

    // array_push($alumnos, $registro);

