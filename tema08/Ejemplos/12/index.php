<?php

// directorio actual
echo 'Directorio actual: ' . getcwd() . '<br>';

// ver contenido del directorio files con scandir
$files = scandir('files', 0);

echo '<pre>';
print_r($files);
echo '<pre>';

// recorre el array de ficheros
foreach($files as $file) {
    // muestra los ficheros y carpetas del directorio distinguiendo entre ficheros y directorios
    if (is_dir('files/' . $file)) {
        echo '[DIR] ';
    } else {
        echo '[FILE] ';
    }
    
    echo $file . '<br>';
}

