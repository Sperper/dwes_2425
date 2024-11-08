<?php

/*
    Modelo: model.mostrar.php
    Descripción: muestra los detalles de un artículo

    Valores recibidos por el método GET:
        -id
    
*/

#Recogemos el valor recibido por el método GET
$id = $_GET["id"];

#Definimos la tabla de artículos
$tabla = generar_tabla();

#Definimos el registro que vamos a mostrar
$registro = buscar_registro($tabla, 'id', $id);


/**
 * Al no tener una base de datos real, si creamos un nuevo regiator y lo añadimos a la tabla,
 * si seleccionamos la opción de mostrar, mostraríaun error en esta página.
 * De esta forma, la página no mostrará ningún error
 */
if ($registro == null) {
    $registro = [
        'id' => null,
        'descripcion' => null,
        'modelo' => null,
        'categoria' => null,
        'unidades' => null,
        'precio' => null
    ];
}
