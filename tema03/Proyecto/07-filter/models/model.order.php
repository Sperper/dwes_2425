<?php
    /*
        Modelo: model.order.php
        Descripción: permite ordenar la tabla por cualquiera de las columnas
        siempre en orden ascendente

        Método GET:
            - criterio: id, nombre, poblacion, curso

    */

    # Obtenemos criterio de ordenación
    $criterio = $_GET['criterio'];
    
    # cargamos la tabla
    $alumnos = get_tabla_alumnos();

    # Ordenar tabla

    // Cargo en un array todos los valores de la columna de ordenación
    $aux = array_column($alumnos, $criterio);

    // Función array_multisort
    array_multisort($aux, SORT_ASC, $alumnos);