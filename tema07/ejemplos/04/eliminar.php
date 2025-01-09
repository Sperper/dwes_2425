<?php

// Eliminar la cookie con nombre 'nombre'
setcookie('nombre', '', time() + 3600);

// Eliminar la cookie con nombre 'edad'
setcookie('edad');

// Eliminar la cookie con nombre 'ciudad'
setcookie('ciudad', '', time() - 1);

echo 'Cookies eliminadas correctamente';

require 'index.php';