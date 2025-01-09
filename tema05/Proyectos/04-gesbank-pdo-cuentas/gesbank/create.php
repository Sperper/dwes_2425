<?php

    /*
        controlador: create.php
        descripción: añade nuevo cuenta a la tabla

        Método POST:

            - detalles del cuenta
    */

    # Archivos de configuración
    include 'config/configDB.php';
    
    # Clases
    include 'class/class.cuenta.php';
    include 'class/class.conexion.php';
    include 'class/class.tabla_cuentas.php';

    # Librerias

    # Model
    include 'models/model.create.php';

    # Vista
    # Redirecciono al controlador index
    header("location: index.php");