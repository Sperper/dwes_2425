<?php
    /*
        controlador: editar.php
        descripción: muestra los detalles de un artícul en modo edición

        parámetros:

            - Método GET:
                - indice donde se encuentra el libro dentro de la tabla
    */

    # Clases
    include 'class/class.libro.php';
    include 'class/class.tabla_libros.php';

    # Librerias

    # Model
    include 'models/model.editar.php';

    # Vista
    include 'views/view.editar.php';