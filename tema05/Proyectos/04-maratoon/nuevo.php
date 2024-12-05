<?php

/*
        controlador: nuevo.php
        descripción: muestra formulario añadir corredor
    */

    # Archivos de configuración
    include 'config/configDB.php';

    # Clases
    include 'class/class.corredor.php';
    include 'class/class.conexion.php';
    include 'class/class.tabla_corredores.php';

    # Librerias

    # Model
    include 'models/model.nuevo.php';

    # Vista
    include 'views/view.nuevo.php';