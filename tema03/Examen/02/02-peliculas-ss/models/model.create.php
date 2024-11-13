<?php
    /*
        model: model.create.php
        descripcion: permite añadir una película a la tabla

        Método POST:
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

    # Añadimos el array a la tabla
    array_push($peliculas, $pelicula);