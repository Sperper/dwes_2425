<?php

    /*
        controlador: filtrar.php
        descripción: muestra las cuentas que cumplen una expresión de búsqueda
    */

    # Archivos de configuración
    include 'config/configDB.php';

    # Clases
    include 'class/class.cuenta.php';
    include 'class/class.conexion.php';
    include 'class/class.tabla_cuentas.php';

    # Librerias

    # Model
    include 'models/model.filtrar.php';

    # Vista
    include 'views/view.index.php';