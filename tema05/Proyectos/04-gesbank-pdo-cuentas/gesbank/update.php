<?php

/*
    controlador: update.php
    descripción: actualiza los detalles de un cuenta
*/

# Archivos de configuración
include 'config/configDB.php';

# Clases
include 'class/class.cuenta.php';
include 'class/class.conexion.php';
include 'class/class.tabla_cuentas.php';

# Librerias

# Model
include 'models/model.update.php';


# Redirecciono  controlador index
header("location: index.php");
