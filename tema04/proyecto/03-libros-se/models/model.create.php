<?php
    /*
        autor: model.create.php
        descripción: añade el nuevo libro a la tabla
        
        Métod POST:
            - id
            - titulo
            - autor
            - editorial 
            - fecha_edicion
            - materia (indice)
            - etiquetas (array)
            - precio
    */

    # Cargo los detalles del  formulario
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $editorial = $_POST['editorial'];
    $fecha_edicion = $_POST['fecha_edicion'];
    $materia = $_POST['materia'];
    $etiquetas = $_POST['etiquetas'];
    $precio = $_POST['precio'];

    # Validación

    # Crear un objeto de la clase tabla_libros
    $obj_tabla_libros = new Class_tabla_libros();

    # Cargo los libros
    $obj_tabla_libros->getDatos();

    # Obtengo el array de materias
    $materias = $obj_tabla_libros->getMaterias();

    # Obtengo el  array de etiquetas
    $array_etiquetas = $obj_tabla_libros->getEtiquetas();

    # Crear un objeto de la clase libro a partir de los detalles del formulario
    $libro = new Class_libro(
        $id,
        $titulo,
        $autor,
        $editorial,
        $fecha_edicion,
        $materia,
        $etiquetas,
        $precio
    );

    # Añadir el libro a la tabla
    $obj_tabla_libros->create($libro);

    # Forma alternativa, ya que la propiedad tabla es pública
    // $obj_tabla_libros->tabla[] = $libro;

    # Obtener la array artículos
    $array_libros = $obj_tabla_libros->tabla;