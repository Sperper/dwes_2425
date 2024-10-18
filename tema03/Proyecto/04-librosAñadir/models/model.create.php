<?php

    /*

        Modelo:  model.create.php
        Descripción: añade un nuevo alumno a la taba

        Método POST:
            - id
            - titulo
            - autor
            - editorial
    */

    # Extraemos los valores del formulario
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $editorial = $_POST['editorial'];
    $genero = $_POST['genero'];
    $precio = $_POST['precio'];


    # Cargar tabla alumnos
    $alumnos = get_tabla_alumnos();

    # Creo un array asociativo con los detalles del nuevo alumno
    $registro = [
        'id' => $id,
        'titulo' => $titulo,
        'autor' => $autor,
        'editorial' => $editorial,
        'genero' => $genero,
        'precio'=> $precio
    ];

    # Añadir nuevo alumno a la tabla
    $alumnos[] = $registro;

    // array_push($alumnos, $registro);

