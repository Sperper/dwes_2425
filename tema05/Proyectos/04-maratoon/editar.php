<?php
    /*
        controlador: editar.php
        descripción: muestra los detalles de un corredor en modo edición

        parámetros:

            - Método GET:
                - id del corredor
    */

    # Archivos de configuración
    include 'config/configDB.php';

    # Clases
    include 'class/class.corredor.php';
    include 'class/class.conexion.php';
    include 'class/class.tabla_corredores.php';

    # Librerias

    # Model
    include 'models/model.editar.php';

    # Vista
    include 'views/view.editar.php';