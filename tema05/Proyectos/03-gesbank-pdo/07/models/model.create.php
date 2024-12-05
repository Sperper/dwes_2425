<?php
    /*
        apellidos: model.create.php
        descripción: añade el nuevo cliente a la tabla
        
        Métod POST (cliente):
            - nombre
            - apellidos
            - ciudad
            - telefono
            - dni
            - emial
            
    */

    # Cargo los detalles del  formulario
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $ciudad = $_POST['ciudad'];
    $telefono = $_POST['telefono'];
    $dni = $_POST['dni'];
    $email = $_POST['email'];

    # Validación

    # Creamos objeto de la clase Class_cliente
    $cliente = new Class_cliente(
        null,
        $apellidos,
        $nombre,
        $telefono,
        $ciudad,
        $dni,
        $email
    );

    # Añadimos cliente a la tabla
    $conexion = new Class_tabla_clientes();

    $conexion->create($cliente);

    exit();
