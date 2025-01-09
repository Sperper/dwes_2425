<?php

/*
        modelo: model.eliminar.php
        descripción: elimina una cuenta de la tabla
        
        Método GET:

            - id: id de la cuenta
    */

# Cargamos el id del alumno que vamos a editar
$id = $_GET['id'];

# Conecto con la base de datos gesbank
$conexion = new Class_tabla_cuentas();

# Eliminar cuenta
$cuenta = $conexion->delete($id);
