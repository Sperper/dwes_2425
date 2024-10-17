<?php

/* 
    Modelo: model.delete.php
*/

# Carga id
$id = $_GET['id'];

# Carga la tabla alumnos
$alumnos = get_tabla_alumnos();

# Buscar id en la tabla  y devuelvo indice;
$indice_eliminar = buscar_tabla($alumnos, 'id', $id);

# Validar la busqueda
if ($indice_eliminar != false) {
    unset($indice_eliminar);
} else {
    echo 'ERROR: Alumno no encontrado';
    exit;
}

#eliminar el indice
