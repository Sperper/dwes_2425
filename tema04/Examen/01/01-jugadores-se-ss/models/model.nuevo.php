<?php

    /*
        Modelo: model.nuevo.php
        Descripción: genera los datos necesarios para añadir nuevo jugador
    */

    
    $obj_tabla_jugadores = new Class_tabla_jugadores();

    $equipos = $obj_tabla_jugadores->getEquipos();

    $posiciones = $obj_tabla_jugadores->getPosiciones();
    

