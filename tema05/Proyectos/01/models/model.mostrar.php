<?php

/*
    modelo: model.mostrar.php
    descripción: muestra los datos del libro

    Método GET:

        - indice de la tabla en la que se encuentra el libro
*/

# Cargamos el indice del libro
$indice = $_GET['indice'];

# Creo un objeto de la clase tabla de libros
$obj_tabla_libros = new Class_tabla_libros();

#  Cargo los datos de libros
$obj_tabla_libros->getDatos();

# Cargo el array de materias - lista desplegable dinámica
$materias = $obj_tabla_libros->getMaterias();

# Cargo el array de etiquetas - lista checbox dinámica
$etiquetas = $obj_tabla_libros->getEtiquetas();

# Obtener el objeto de la clase libro correspondiente a ese índice
$libro = $obj_tabla_libros->read($indice);

# Forma alternativa por propiedad de no encapsulamiento
// $libro = $obj_tabla_libros->tabla[$indice];
// var_dump($libro);
// exit();