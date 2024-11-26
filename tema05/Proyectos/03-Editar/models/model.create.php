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
    $fechaNac = $_POST['fechaNac'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $nacionalidad = $_POST['nacionalidad'];
    $dni = $_POST['dni'];
    $id_curso = $_POST['id_curso'];

    # Validación

    # Creamos objeto de la clase Class_alumno
    $alumno = new Class_alumno (
        null,
        $nombre,
        $apellidos,
        $email,
        $telefono,
        $nacionalidad,
        $dni,
        $fechaNac, 
        $id_curso
    );

    # Añadimos alumno a la tabla
    $alumnos = new Class_tabla_alumnos('localhost', 'root', '', 'fp');

    $alumnos->create($alumno);

    # Redirecciono al controlador index
    header("location: index.php");