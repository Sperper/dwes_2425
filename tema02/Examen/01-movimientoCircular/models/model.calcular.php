<?php

    // Declaramos las variables dando el valor que se le ha pasado por el formulario
    $radio = $_POST["radio"];
    $frecuenciaRotacion = $_POST["frecuencia"];
    $masaObjeto = $_POST["masa"];
    
    // Hacemos los calculos
    $velocidadTangencial = 2 * pi() * $radio * $frecuenciaRotacion; 
    $aceleracionCentripeta = pow($velocidadTangencial, 2) / $radio;
    $fuerzaCentripeta = $masaObjeto * $aceleracionCentripeta;
    $periodo = 1/$frecuenciaRotacion;