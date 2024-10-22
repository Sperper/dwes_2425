<?php

    /*
    Modelo: modelEditar.php
    Descripción: Edita un elemento de la tabla

    Método GET:
            - id: Identificador del elemento a eliminar
    */

    $libros = generar_tabla();
    
    $id = $_GET['id'];

    $indice_editar = buscar_en_tabla($libros, 'id', $id);

    // comparación estricta para distinguir el false del 0
    if ($indice_editar !== false) {
        // Elimino el libro seleccionado
        $libro = $libros[$indice_editar];
        

    } else {
        echo "No se encontró el elemento a eliminar";
        exit();
    }
?>