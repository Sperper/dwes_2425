<?php
    /*
        Controlador: filter.php
        Descripción: permite filtrar la tabla a partir de una expresión
        Todos los elementos de la tabla que contengan esta expresión serán mostrados
    */

    # libreria
    include 'libs/funciones.php';

    # Modelo
    include 'models/model.filter.php';

    # Vista
    include 'views/view.index.php';