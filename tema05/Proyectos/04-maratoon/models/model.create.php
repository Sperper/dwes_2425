<?php
/*
    apellidos: model.create.php
    descripción: añade el nuevo corredor a la tabla
    
    Métod POST (corredor):
        - id
        
*/

# Cargo los detalles del  formulario

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$ciudad = $_POST['ciudad'];
$fechaNacimiento = $_POST['fechaNacimiento'];
$sexo = $_POST['sexo'];
$email = $_POST['email'];
$dni = $_POST['dni']; 
$id_categoria = $_POST['id_categoria'];
$id_club = $_POST['id_club'];

# Validación

# Creamos objeto de la clase Class_corredor
$corredor = new Class_corredor(
    null,
    $nombre,
    $apellidos,
    $ciudad,
    $fechaNacimiento,
    $sexo,
    $email,
    $dni,
    null,
    $id_categoria,
    $id_club
);

# Añadimos alumno a la tabla
$corredores = new Class_tabla_corredores();

$corredores->create($corredor);

# Redirecciono al controlador index
header("location: index.php");