<?php

    /*
    Modelo: modelCreate.php
    Descripción: Añade un elemento a la tabla

    Método POST:
            - id: Identificador del elemento a eliminar
            - titulo
            - autor
            - genero
            - precio
    */

    $libros = generar_tabla();

    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $genero = $_POST['genero'];
    $precio = $_POST['precio'];

    # Creo un array asociativo con los detalles del nuevo libro

    $libro = [
        'id' => $id,
        'titulo' => $titulo,
        'autor' => $autor,
        'genero' => $genero,
        'precio' => $precio
    ];

    # Añado nuevo libro a la tabla
    array_push($libros, $libro);
?>