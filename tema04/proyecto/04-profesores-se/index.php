<?php

    /*
        Nombre: index.php
        Descripcion: Controlador principal que carga la tabla de profesores
    */

    # Clases
    include "class/class.profesor.php";
    include "class/class.tabla_profesores.php";

    # Modelo
    include "models/model.index.php";

    # Vista
    include "views/view.index.php";