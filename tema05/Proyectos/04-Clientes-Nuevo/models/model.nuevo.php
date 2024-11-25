<?php

    /*
        Modelo: model.nuevo.php
        Descripción: genera los datos necesarios para añadir nuevo alumno
    */

    # Símbolo monetario local
    setlocale(LC_MONETARY,"es_ES");

    # Creo un objeto de la clase tabla alumnos
    $clientes = new Class_tabla_clientes(
            'localhost',
            'root',
            '',
            'gesbank'
    );

    

