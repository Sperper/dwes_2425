<?php
/*
        controlador: eliminar.php
        descripción: elimina una cuenta de la tabla

        parámetros:

            - Método GET:
                - id - id de la cuenta
    */

# Archivos de configuración
include 'config/configDB.php';

# Clases
include 'class/class.cuenta.php';
include 'class/class.conexion.php';
include 'class/class.tabla_cuentas.php';

# Librerias

# Model
include 'models/model.eliminar.php';


# Redirecciono  controlador index
header("location: index.php");
