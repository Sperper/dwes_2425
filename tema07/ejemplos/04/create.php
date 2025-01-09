<?php

    // Crear una cookie con el nombre 'nombre' y el valor 'Juan' que caduca en 1 hora
    setcookie('nombre', 'Juan', time() + 3600);

    // Crear una cookie con valor 30 que caduca en 1 hora
    setcookie('edad', 30, time() + 3600);

    // Crear una cooke ciudad con valor Ubrique que caduca en 1 hora
    setcookie('ciudad', 'Ubrique', time() + 3600);

    echo 'Cookies creadas correctamente';
    
    require 'index.php';