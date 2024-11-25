<?php

/*
    Modelo: model.update.php
    Descripción: actualiza los datos del registro a partir de los detalles del formulario

    Método POST:
                - id
                - descripcion
                - modelo
                - genero
                - materia
                - unidades
                - precio
                - categorias
    
    Método GET:

                - indice (indice de la tabla correspondiente a dicho registro)
*/

# Símbolo monetario local
setlocale(LC_MONETARY, "es_ES");

# Cargo el indice del libro que voy a editar
$indice = $_GET['indice'];

# Cargo los detalles del  formulario
$id = $_POST['id'];
$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$editorial = $_POST['editorial'];
$fecha_edicion = $_POST['fecha_edicion'];
$materia = $_POST['materia'];
$etiqueta = $_POST['etiquetas'];
$precio = $_POST['precio'];

# Crear un objeto de la clase artículos a partir de los detalles del formulario
$libro = new Class_libro(
    $id,
    $titulo,
    $autor,
    $editorial,
    $fecha_edicion,
    $materia,
    $etiqueta,
    $precio
);


# Creo un objeto de la clase tabla artículos
$obj_tabla_libros = new Class_tabla_libros();

# Cargo los libros
$obj_tabla_libros->getDatos();

# Extraer array de materias para la vista
$materias = $obj_tabla_libros->getMaterias();

# Obtengo el array de etiquetas
$array_etiquetas = $obj_tabla_libros->getEtiquetas();


# Actualizo
$obj_tabla_libros->update($libro, $indice);

# Comando alternativo por la propiedad NO encapsulamiento
$obj_tabla_libros->tabla[$indice] = $libro;

# Obtener la array artículos
$array_libros = $obj_tabla_libros->tabla;






