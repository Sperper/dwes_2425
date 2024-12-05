<?php
/*
    controlador: mostrar.php
    descripción: muestra los detalles de un corredor sin edición

    parámetros:

        - Método GET:
            - indice donde se encuentra el corredor dentro de la tabla
*/

# Archivos de configuración
include 'config/configDB.php';

# Clases
include 'class/class.corredor.php';
include 'class/class.conexion.php';
include 'class/class.tabla_corredores.php';

# Librerias

# Model
include 'models/model.mostrar.php';

# Vista
include 'views/view.mostrar.php';