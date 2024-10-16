<?php

/*
Model: model.create.php
Descripcion: añade un nuevo alumno a la tabla

 Método POST:
     id:
     nombre:
     poblacion:
     curso:
*/

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$poblacion = $_POST['poblacion'];
$curso = $_POST['curso'];

# Cargar la tabla alumnos
$alumnos = get_tabla_alumnos();

# Crear un array asociativo con los detalles del nuevo alumno
$alumno = [
    'id' => $id,
    'nombre' => $nombre,
    'poblacion' => $poblacion,
    'curso' => $curso
];

array_push($alumnos, $alumno);