<?php
/*
    autor: model.create.php
    descripción: añade el nuevo jugador a la tabla
    
    Métod POST:
        
*/

# Inicializo las variables
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$nacionalidad = $_POST['nacionalidad'];
$num_camiseta = $_POST['num_camiseta'];
$altura = $_POST['altura'];
$peso = $_POST['peso'];
$valor_mercado = $_POST['valor_mercado'];
$equipo = $_POST['equipo'];
$posiciones = $_POST['posiciones'];

$jugador = new Class_jugador(
    $id,
    $nombre,
    $fecha_nacimiento,
    $nacionalidad,
    $num_camiseta,
    $altura,
    $peso,
    $valor_mercado,
    $equipo,
    $posiciones
);

$obj_tabla_jugadores = new Class_tabla_jugadores();

$equipos = $obj_tabla_jugadores->getEquipos();

$posicones = $obj_tabla_jugadores->getPosiciones();

$obj_tabla_jugadores->create($jugador);

$obj_tabla_jugadores->getDatos();

$array_jugadores = $obj_tabla_jugadores->tabla;