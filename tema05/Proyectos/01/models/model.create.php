<?php
/*
    autor: model.create.php
    descripción: añade el nuevo artículo a la tabla
    
    Métod POST:
        - id
        - titulo
        - autor
        - editorial
        - fecha_edicion
        - materia (índice)
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
$etiqueta = $_POST['etiquetas'];
$precio = $_POST['precio'];

# Validación

# Crear un objeto de la clase tabla_libros
$obj_tabla_libros = new Class_tabla_libros();

# Cargo los artículos
$obj_tabla_libros->getDatos();

# Obtengo el array de marcas
$materias = $obj_tabla_libros->getMaterias();

# Obtengo el  array de categorias
$array_etiquetas = $obj_tabla_libros->getEtiquetas();

# Crear un objeto de la clase artículos a partir de los detalles del formulario
$libro = new Class_libro(
    $id,
    $titulo,
    $autor,
    $editorial,
    $fecha_edicion,
    $materia,
    $etiqueta,
    $precio
);

# Añadir el artículo a la tabla
$obj_tabla_libros->create($libro);
# Forma alterenativa ya que la propiedad tabla es pública
// $obj_tabla_libros->tabla[] = $libro;

# Obtener la array artículos
$array_libros = $obj_tabla_libros->getTabla();