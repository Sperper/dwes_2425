<?php

/*
        model: model.update.php
        descripción: permite actualizar los detalles de una película

        Método GET:
            - indice: el índice de la tabla en la que se encuentra la película
        
        Métod POST:
            - id
            - titulo
            - pais
            - director
            - genero
            - año 
    */

    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $pais = $_POST['pais'];
    $director = $_POST['director'];
    $genero = $_POST['genero'];
    $año = $_POST['año'];

    # Cargamos la tabla de peliculas
    $peliculas = generar_tabla();

    # Creamos el array pelicula
    $pelicula = [
        'id' => $id,
        'titulo' => $titulo,
        'pais' => $pais,
        'director' => $director,
        'genero' => $genero,
        'año' => $año
    ];

    $peliculas[$id -1] = $pelicula;

   

    

   