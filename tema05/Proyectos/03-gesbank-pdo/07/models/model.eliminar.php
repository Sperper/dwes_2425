<?php

/*
        modelo: model.eliminar.php
        descripción: elimina alumno de la tabla
        
        Método GET:

            - id: id del alumno
    */

# Cargamos el id del alumno que vamos a editar
$id = $_GET['id'];

# Conecto con la base de datos gesbank
$conexion = new Class_tabla_clientes();

# Eliminar alumno
$cliente = $conexion->delete($id);
