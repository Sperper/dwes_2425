<?php
    /*
        autor_id: model.create.php
        descripción: añade el nuevo libro a la tabla
        
        Métod POST (libro):
            - titulo
            - autor_id
            - editorial_id
            - precio
            - stock
            - fecha_edicion
            - isbn
            - generos_id  - convertir a string
            
    */

    # Cargo los detalles del  formulario
    $titulo = $_POST['titulo'];
    $autor_id = $_POST['autor_id'];
    $editorial_id = $_POST['editorial_id'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $fecha_edicion = $_POST['fecha_edicion'];
    $isbn = $_POST['isbn'];

    // convertimos los géneros en string
    $generos_id = implode(',', $_POST['generos_id']);

    # Validación

    # Creamos objeto de la clase Class_libro
    $libro = new Class_libro(
        null            ,
        $titulo         ,
        $precio         ,
        $stock          ,
        $fecha_edicion  ,
        $isbn           ,
        $autor_id       ,
        $editorial_id   ,
        $generos_id     
    );

    # Añadimos libro a la tabla
    $conexion = new Class_tabla_libros();

    $conexion->create($libro);

