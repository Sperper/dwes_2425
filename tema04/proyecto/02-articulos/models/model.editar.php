<?php

$id = $_GET['id'];

$obj_tabla_articulos = new Class_tabla_articulos();

# Cargo el array de marcas - lista desplegable dinamica
$marcas = $obj_tabla_articulos->getMarcas();

# cargo el array de categorias - lista desplegable dinamica
$categorias = $obj_tabla_articulos->getCategorias();

# Obtener el indice del artculo en la tabla
$indice = $obj_tabla_articulos->devolver_indice($id);

# Obtener el objeto de la clave articulo correspondiente a ese indice
