<?php

    // Mostrar el valor de la cookie con nombre 'nombre'
    if (isset($_COOKIE['nombre'])) {
        echo 'El valor de la cookie "nombre" es: ' . $_COOKIE['nombre'];
    } else {
        echo 'La cookie "nombre" no está establecida.';
    }

    echo '<br>';

    // Mostrar el valor de la cookie con nombre 'edad'
    if (isset($_COOKIE['edad'])) {
        echo 'El valor de la cookie "edad" es: ' . $_COOKIE['edad'];
    } else {
        echo 'La cookie "edad" no está establecida.';
    }

    echo '<br>';

    // Mostrar el valor de la cookie con nombre 'ciudad'
    if (isset($_COOKIE['ciudad'])) {
        echo 'El valor de la cookie "ciudad" es: ' . $_COOKIE['ciudad'];
    } else {
        echo 'La cookie "ciudad" no está establecida.';
    }

    echo '<br>';
    print_r($_COOKIE);

    require 'index.php';