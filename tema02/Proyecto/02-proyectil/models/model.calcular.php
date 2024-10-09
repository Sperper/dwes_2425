<?php

    /**´
     * Model: model.calcular.php
     * Descripcion: Calcular el ángulo en radianes, velocidad inicial X, valocidad inicial Y
     * alcance máximo del proyectil, tiempo de vulo del proyectil, altura máxima de proyectil
     */

    // Variables
    $velocidadInicial = $_POST['VelocidadInicial'];
    $anguloInclinacion = $_POST['AnguloDeLanzamiento'];
    define("gravedad", 9.8);

    // Se realizan las operaciones
    $radianes = deg2rad($anguloInclinacion);
    $velocidadInicialX = $velocidadInicial * cos($radianes);
    $velocidadInicialY = $velocidadInicial * sin($radianes);
    $alcanceMax = ($velocidadInicial * $velocidadInicial * sin(2 * $radianes))/gravedad;
    $tiempo = (2 * $velocidadInicialY)/gravedad;
    $alturaMax = ($velocidadInicial * $velocidadInicial * sin($radianes) * sin($radianes))/(2 * gravedad);
