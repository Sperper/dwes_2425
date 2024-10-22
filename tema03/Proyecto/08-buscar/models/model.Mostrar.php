<?php 
$libros = generar_tabla();

$id = $_GET['id'];

$indice_mostrar = buscar_en_tabla($libros, 'id', $id);

if ($indice_mostrar !== false ) {
    $libro = $libros[$indice_mostrar];
} else {
    echo ("Libro no encontrado");
}


?>