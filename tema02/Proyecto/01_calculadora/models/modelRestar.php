<?php
/**
 * Modelo: modelSumar.php
 * Descripcion : resta los valores del formulario
 */

// print_r($_GET);

// Cargo en variables 
$valor1 = $_GET["valor1"];
$valor2 = $_GET["valor2"];

// Realizo los calculos
$resultado = $valor1 - $valor2;

