<?php

    /*
        controlador: update.php
        descripción: actualiza los detalles de un corredor
    */

    # Archivos de configuración
    include 'config/configDB.php';

    # Clases
    include 'class/class.corredor.php';
    include 'class/class.conexion.php';
    include 'class/class.tabla_corredores.php';

    # Librerias

    # Model
    include 'models/model.update.php';

    # Redirecciono  index
    header("location: index.php");
    