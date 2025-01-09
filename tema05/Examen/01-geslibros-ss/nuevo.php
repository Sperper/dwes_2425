<?php

    /*
        controlador: nuevo.php
        descripción: muestra formulario añadir libro
    */

    # config
    include "config/configDB.php";

    # clases
    include "class/class.libro.php";
    include "class/class.conexion.php";
    include "class/class.tabla_libros.php";

    # modelo
    include "models/model.nuevo.php";

    # vista
    include "views/view.nuevo.php";