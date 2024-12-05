<?php
/*
        controlador: eliminar.php
        descripción: elimina un corredor de la tabla

        parámetros:

            - Método GET:
                - id - id del corredor que se desea eliminar
    */

# Archivos de configuración
include 'config/configDB.php';

# Clases
include 'class/class.corredor.php';
include 'class/class.conexion.php';
include 'class/class.tabla_corredores.php';
# Librerias

# Model
include 'models/model.eliminar.php';

# Cargo el controlador index
header("location: index.php");