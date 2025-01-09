<?php

    /*
        controlador: create.php
        descripción: añade nuevo cliente a la tabla

        Método POST:

            - detalles del cliente
    */

    # Archivos de configuración
    include 'config/configDB.php';
    
    # Clases
    include 'class/class.libro.php';
    include 'class/class.conexion.php';
    include 'class/class.tabla_libros.php';

    # Librerias

    # Model
    include 'models/model.create.php';

    # Vista
    # Redirecciono al controlador index
    header("location: index.php");