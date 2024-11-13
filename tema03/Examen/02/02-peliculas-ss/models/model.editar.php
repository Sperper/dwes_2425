<?php

    /*
        model: model.editar.php
        descripción: carga los datos de una película para mostrarlos en modo edición en el formulario

        Parámetros GET:

            - indice: indice de la tabla en la que se encuentra la película

    */

    $indice = $_GET['indice'];

    # Inicializo los datos de la película
    $id;
    $titulo;
    $pais;
    $director;
    $genero;
    $año;

    # Inicilizo pelicula
    $pelicula = [];

    # Cargo la tabla de películas
    $tabla_peliculas = generar_tabla();

    $pelicula = $tabla_peliculas[$indice];

    # Le doy los valores a los datos de la película
    $id = $pelicula['id'];
    $titulo = $pelicula['titulo'];
    $pais = $pelicula['pais'];
    $director = $pelicula['director'];
    $genero = $pelicula['genero'];
    $año = $pelicula['año'];

    

