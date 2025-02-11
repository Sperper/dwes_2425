<?php

// directorio actual
echo 'Directorio actual: ' . getcwd() . '<br>';

// abrir directorio
$dir = opendir('files');

// mensaje
echo 'Archivos y directios de files: <br>';

// Leer el directorio
while ($file = readdir($dir)) {
    if (is_file('files/'. $file)) {
        echo 'Archivo: ' . $file . '-' . filesize('files/'. $file) . 'bytes <br>';
    } else {
        echo 'Directorio '. $file . '<br>';
    }
}

closedir($dir);

