<?php
/*
    controlador: editar.php
    descripción: muestra los detalles de un libro en modo edición

    parámetros:

        - Método GET:
            - id  id del libro que deseo editar
*/

# Clases
include 'class/class.libro.php';
include 'class/class.tabla_libros.php';

# Librerias

# Model
include 'models/model.editar.php';

# Vista
include 'views/view.editar.php';