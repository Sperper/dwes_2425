<?php

$id = $_GET['id'];

# Creo el objeto de la clase Class_tabla_articulo
$obj_tabla_articulos = new Class_tabla_articulos();

# Cargo la tabla de datos
$obj_tabla_articulos->getDatos();

# Cargo el array de marcas - lista desplegable dinamica
$marcas = $obj_tabla_articulos->getMarcas();

# cargo el array de categorias - lista desplegable dinamica
$categorias = $obj_tabla_articulos->getCategorias();

# Obtener el indice del artculo en la tabla
$indice = $obj_tabla_articulos->devolver_indice($id);

# Obtener el objeto de la clase articulo correspondiente a ese indice
$articulo = $obj_tabla_articulos->read($indice);

var_dump($articulo);
exit;