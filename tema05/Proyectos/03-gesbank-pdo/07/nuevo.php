<?php

/*
        controlador: nuevo.php
        descripción: muestra formulario añadir cliente
    */

    # Archivos de configuración
    include 'config/configDB.php';

    # Clases
    include 'class/class.cliente.php';
    include 'class/class.conexion.php';
    include 'class/class.tabla_clientes.php';

    # Librerias

    # Model
    include 'models/model.nuevo.php';

    # Vista
    include 'views/view.nuevo.php';