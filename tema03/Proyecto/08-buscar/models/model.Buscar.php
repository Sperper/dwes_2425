<?php 
$libros = generar_tabla();

$expresion = $_GET['expresion'];


//Cargo en un array todos los valores dek expresion de ordenacion
$aux = array_column($libros, $expresion);

# Filtrar la tabla a partir de la expresion
$aux = [];
foreach ($libros as $libro) {
    if(array_search($expresion, $libro, false)){
        $aux[]= $libro;

    }
}
    # Validar búsqueda
    if (!empty($aux)){
        $libros = $aux;

    }


?>