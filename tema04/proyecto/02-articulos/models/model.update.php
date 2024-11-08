<?php 
$indice = $_GET['indice'];

$obj_tabla_articulos = new Class_tabla_articulos();

$obj_tabla_articulos->getDatos();
