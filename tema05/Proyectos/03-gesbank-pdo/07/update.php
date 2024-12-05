<?php

    /*
        controlador: update.php
        descripción: actualiza los detalles de un cliente
    */

    # Archivos de configuración
    include 'config/configDB.php';

    # Clases
    include 'class/class.cliente.php';
    include 'class/class.conexion.php';
    include 'class/class.tabla_clientes.php';

    # Librerias

    # Model
    include 'models/model.update.php';

    # Redirecciono  index
    header("location: index.php");
    