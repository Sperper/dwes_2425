<?php

/*
    controlador: ordenar.php
    descripción: ordena los detalles de los alumnos
*/

# config
include "config/configDB.php";

# clases
include "class/class.libro.php";
include "class/class.conexion.php";
include "class/class.tabla_libros.php";

# modelo
include "models/model.ordenar.php";

# vista
include "views/view.index.php";