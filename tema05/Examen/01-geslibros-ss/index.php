<?php

    /*
        controlador: index.php
        descripción: muestra los detalles de los alumnos
    */

    # config
    include "config/configDB.php";

    # clases
    include "class/class.libro.php";
    include "class/class.conexion.php";
    include "class/class.tabla_libros.php";

    # modelo
    include "models/model.index.php";

    # vista
    include "views/view.index.php";
