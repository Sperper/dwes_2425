<?php
session_start();

echo "Session ID: " . session_id() . "<br>";
echo "Session Name: " . session_name() . "<br>";

echo "Nombre: " . $_SESSION['nombre'] . "<br>";
echo "Email: " . $_SESSION['email'] . "<br>";
echo "Perfil: " . $_SESSION['perfil'] . "<br>";

include 'index.php';

?>