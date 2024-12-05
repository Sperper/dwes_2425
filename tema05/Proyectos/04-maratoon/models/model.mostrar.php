<?php

/*
    modelo: model.mostrar.php
    descripción: carga los datos del corredor que deseo actualizar

    Método GET:

        - indice de la tabla en la que se encuentra el corredor
*/

# Cargamos el indice del corredor
$id = $_GET['id'];

# Creo un objeto de la clase tabla de corredores
$obj_tabla_corredores = new Class_tabla_corredores();

#  Cargo los datos de los corredores
$obj_tabla_corredores->getCorredores();

# Cargo el array de categorías - lista desplegable dinámica
$categorias = $obj_tabla_corredores->getCategorias();

# Cargo el array de clubs - lista checbox dinámica
$clubs = $obj_tabla_corredores->getClubs();

# Obtener el objeto de la clase corredor correspondiente a ese índice
$corredor = $obj_tabla_corredores->read($id);

# Obtener la categoría correspondiente al corredor
$categoria_corredor = implode($categorias[$corredor->id_categoriaimplode()]);

# Obtener el club correspondiente al corredor
$club_corredor = $clubs[$corredor->id_club];

# Forma alternativa por la propiedad de no encapsulamiento
// $libro = $obj_tabla_libros->tabla[$indice];