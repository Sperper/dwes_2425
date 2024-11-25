<?php

$server = "localhost";
$user = 'root';
$pass = '';
$dbname = 'fp';

$db = new mysqli($server, $user, $pass, $dbname);
if ($db->connect_error) {
    die("ERROR DE CONEXION " . $db->connect_error);
}

// Preperar sentencia
$sql = "
        INSERT INTO
            alumnos
            (
            id,
            nombre, 
            apellidos,
            email, 
            telefono,
            nacionalidad,
            dni,
            fechaNac,
            id_curso
            )
        VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?)
    ";

$stmt = $db->prepare($sql);

if (!$stmt) {
    die("ERROR AL PREPARAR SQL" . $db->error);
}

$stmt->bind_param("sssisssi", $nombre, $apellidos, $email, $telefono, $nacionalidad, $dni, $fechaNac, $id_curso);

$nombre = "Samuel";
$apellidos = "Pérez Pérez";
$email = "samuel@gmail.com";
$telefono = "123456879";
$nacionalidad =  "España";
$dni = "12345678P";
$fechaNac = "2004/09/04";
$id_curso = 1;

$stmt->execute();

// 4. Mensaje
echo "registro insertado correctamente";

// Cerrar la sentencia y la conexion
$stmt->close();
$db->close();

