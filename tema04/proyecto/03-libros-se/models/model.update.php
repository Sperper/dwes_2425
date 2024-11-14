<?php

/*
     autor: model.create.php
     descripción: añade el nuevo libro a la tabla
     
     Métod POST:
         - id
         - titulo
         - autor
         - editorial 
         - fecha_edicion
         - materia (indice)
         - etiquetas (array)
         - precio
 */

# Símbolo monetario local
setlocale(LC_MONETARY, "es_ES");

# Cargo los detalles del  formulario
$id = $_POST['id'];
$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$editorial = $_POST['editorial'];
$fecha_edicion = $_POST['fecha_edicion'];
$materia = $_POST['materia'];
$etiquetas = $_POST['etiquetas'];
$precio = $_POST['precio'];

# Crear un objeto de la clase artículos a partir de los detalles del formulario
$libro = new Class_libro(
    $id,
    $titulo,
    $autor,
    $editorial,
    $fecha_edicion,
    $materia,
    $etiquetas,
    $precio
);

# Cargo el índice de la tabla donde se encuentra el artículo
$indice = $_GET['indice'];

# Creo un objeto de la clase tabla artículos
$obj_tabla_libros = new Class_tabla_libros();

# Cargo los datos en el objeto de la clase tabla de artículos
$obj_tabla_libros->getDatos();

# Obtengo los datos de las materias
$materias = $obj_tabla_libros->getMaterias();

# Obtengo las etiquetas
$etiquetas = $obj_tabla_libros->getEtiquetas();

# Actualizo la tabla 
$obj_tabla_libros->update($libro, $indice);

# Otra forma
# $obj_tabla_libros->tabla[$indice] = $libro;

# Extraer array de marcas para la vista
$array_libros = $obj_tabla_libros->tabla;






