<?php
    /*
        controlador: eliminar.php
        descripción: elimina un artículo de la tabla

        parámetros:

            - Método GET:
                - indice - indice del artículo que voy a eliminar
    */

    # Clases
    include 'class/class.libro.php';
    include 'class/class.tabla_libros.php';

    # Librerias

    # Model
    include 'models/model.eliminar.php';

    # Vista
    include 'views/view.index.php';