<?php 

$libros = generar_tabla();

$criterio = $_GET['criterio'];


//Cargo en un array todos los valores dek criterio de ordenacion
$aux = array_column($libros, $criterio);

// Validar criterio
if (!in_array($criterio, array_keys($libros[0]))) {
    echo "No se ha encontrado el criterio";
    exit();

    
}

//Funcion array multisort
array_multisort($aux, SORT_ASC, $libros);


?>