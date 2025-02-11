<?php

$ruta = 'file/datos.txt';

$statdatos = stat($ruta);

echo '<br>';
print_r($statdatos);
echo '<br>';