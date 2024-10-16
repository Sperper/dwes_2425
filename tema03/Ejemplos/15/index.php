<?php

/*
    Funcion implode
*/

$array_elementos = [
    'portero',
    'casa',
    'castillo',
    'mesa',
    'locowin',
    'trabajar'

];

$array_elementos = implode(', ', $array_elementos);

echo $array_elementos;