<?php
    /*
        controlador: mostrar.php
        descripción: muestra los detalles de una cuenta sin edición

        parámetros:

            - Método GET:
                - id - cuenta
    */

    # Archivos de configuración
    include 'config/configDB.php';

    # Clases
    include 'class/class.cuenta.php';
    include 'class/class.conexion.php';
    include 'class/class.tabla_cuentas.php';

    # Librerias

    # Model
    include 'models/model.mostrar.php';

    # Vista
    include 'views/view.mostrar.php';