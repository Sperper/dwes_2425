<?php

    /*
        controlador: create.php
        descripción: añade nuevo corredor a la tabla

        Método POST:

            - detalles del corredor
    */

    # Archivos de configuración
    include 'config/configDB.php';
    
    # Clases
    include 'class/class.cliente.php';
    include 'class/class.conexion.php';
    include 'class/class.tabla_clientes.php';

    # Librerias

    # Model
    include 'models/model.create.php';

    # Vista
    // include 'views/view.index.php';