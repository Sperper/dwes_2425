<?php

    /*
    Modelo: modelUpdate.php
    Descripción: Actualiza un elemento a la tabla

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

    # obtenemos el indice del libro que quiero editar
    $id_editar = $_GET['id'];

    # obtenemos el indice del libro
    $indice_libro_editar = buscar_en_tabla($libros, 'id', $id_editar);

    # Creo un array asociativo con los detalles del nuevo libro

    $libro = [
        'id' => $id,
        'titulo' => $titulo,
        'autor' => $autor,
        'genero' => $genero,
        'precio' => $precio
    ];

    # actualizamos el libro en su posicion correspondiente
    $libros[$indice_libro_editar] = $libro;
?>