<?php

/*
    Modelo: model.index.php
    Descripción: muestra los corredores

*/

# Símbolo monetario local
setlocale(LC_MONETARY, "es_ES");

# Creo un objeto de la clase tabla alumnos
$tabla_corredores = new Class_tabla_corredores();

# Cargo tabla de alumnos
$corredores = $tabla_corredores->getCorredores();