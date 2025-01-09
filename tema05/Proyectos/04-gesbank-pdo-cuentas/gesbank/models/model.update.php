<?php

/*
    Modelo: model.update.php
    Descripción: actualiza los datos del cuenta

     Métod POST:
        
        - num_cuenta
        - cuenta
        - fecha_alta
        - fecha_ul_mov
        - num_movtos
        - saldo
    
    Método GET:

        - id del cuenta
*/

# Símbolo monetario local
setlocale(LC_MONETARY, "es_ES");

# Cargo el id del cuenta
$id = $_GET['id'];

# Cargo los detalles del  formulario
$num_cuenta = $_POST['num_cuenta'];
$id_cliente = $_POST['id_cliente'];
$fecha_alta = $_POST['fecha_alta'];
$fecha_ul_mov = $_POST['fecha_ul_mov'];
$num_movtos = $_POST['num_movtos'];
$saldo = $_POST['saldo'];

# Validación

# Creamos objeto de la clase Class_alumno
$cuenta = new Class_cuenta (
    $id,
    $num_cuenta,
    $id_cliente,
    $fecha_alta,
    $fecha_ul_mov,
    $num_movtos,
    $saldo
);

# Conecto con la base de datos gesbank
$conexion = new Class_tabla_cuentas();

# Llamo al método update de Class_tabla_cuentas
$conexion->update($cuenta, $id);