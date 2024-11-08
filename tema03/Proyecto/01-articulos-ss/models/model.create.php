<?php

/*

    Modelo: model.create.php
    Descripción: añade un nuevo artículo a la lista

    Valores recibidos por el método POST:
        -id
        -descripcion
        -modelo
        -categoria
        -unidades
        -precio
*/

#Recogemos los valores del método POST
$id = $_POST["id"];
$descripcion = $_POST["descripcion"];
$modelo = $_POST["modelo"];
$categoria = $_POST["categoria"];
$unidades = $_POST["unidades"];
$precio = $_POST["precio"];

#Creamos el nuevo registro
$registro = [
    'id' => $id,
    'descripcion' => $descripcion,
    'modelo' => $modelo,
    'categoria' => $categoria,
    'unidades' => $unidades,
    'precio' => $precio
];


#Definimos la tabla de artículos
$tablaSinActualizar = generar_tabla();


#Definimos la lista final y le añadimos el nuevo registro
$tabla = nuevo($tablaSinActualizar, $registro);
