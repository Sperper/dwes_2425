<?php

    /*
        Modelo: model.index.php
        Descripción: genera array objetos de la clase jugadores
    */

    
    $obj_tabla_jugadores = new Class_tabla_jugadores();

    $equipos = $obj_tabla_jugadores->getEquipos();

    $posicones = $obj_tabla_jugadores->getPosiciones();

    $obj_tabla_jugadores->getDatos();

    $array_jugadores = $obj_tabla_jugadores->tabla;

