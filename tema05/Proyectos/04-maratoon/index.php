<?php

    /*
        controlador: index.php
        descripción: muestra los detalles de los corredores
    */

    # Archivos de configuración
    include 'config/configDB.php';

    # Clases
    include 'class/class.corredor.php';
    include 'class/class.conexion.php';
    include 'class/class.tabla_corredores.php';

    # Librerias

    # Model
    include 'models/model.index.php';

    # Vista
    include 'views/view.index.php';