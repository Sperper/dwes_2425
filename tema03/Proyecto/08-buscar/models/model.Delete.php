<?php

    /*
    Modelo: modelEliminar.php
    Descripción: Elimina un elemento de la tabla
    */
    $libros = generar_tabla();

    $id = $_GET['id'];

    $indice_eliminar = buscar_en_tabla($libros, 'id', $id);

    // comparación estricta para distinguir el false del 0
    if ($indice_eliminar !== false) {
        // Elimino el libro seleccionado
        unset ($libros[$indice_eliminar]);
        $libros = array_values($libros);

    } else {
        echo "No se encontró el elemento";
        exit();
    }
?>