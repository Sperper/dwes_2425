<?php
    /*
        apellidos: model.create.php
        descripción: añade el nuevo alumno a la tabla
        
        Métod POST (alumno):
            - id
            
    */

    # Cargo los detalles del  formulario
  
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $ciudad = $_POST['ciudad'];
    $dni = $_POST['dni'];

    # Validación

    # Creamos objeto de la clase Class_alumno
    $cliente = new Class_cliente (
        null,
        $apellidos,
        $nombre,
        $telefono,
        $ciudad,
        $dni,
        $email
    );

    # Añadimos alumno a la tabla
    $clientes = new Class_tabla_clientes('localhost', 'root', '', 'gesbank');

    $clientes->create($cliente);

    # Redirecciono al controlador index
    header("location: index.php");