<!DOCTYPE html>
<html lang="es">
<head>
    <?php include 'views/layouts/layout.head.html'; ?>
    <title>Gestión de Libros - Home </title>
</head>
<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <?php include 'views/partials/partial.header.php'; ?>

                
        <!-- Menú principal -->
        <?php include 'views/partials/partial.menu.php';?>
       
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <!-- Mostramos el encabezado de la tabla -->
                    <tr>
                        <th>Id</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Editorial</th>
                        <th>Edición</th>
                        <th>Materia</th>
                        <th>Etiquetas</th>
                        <th class='text-end'>Precio</th>
                        <!-- columna de acciones -->
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Mostramos cuerpo de la tabla -->
                    <?php foreach ($array_libros as $indice => $libro): ?>
                        <tr class="align-middle">
                            <!-- Detalles de artículos -->
                            <td><?= $libro->id ?></td>
                            <td><?= $libro->titulo ?></td>
                            <td><?= $libro->autor ?></td>
                            <td><?= $libro->editorial ?></td>
                            <td><?= $libro->fecha_edicion ?></td>
                            <td><?= $materias[$libro->materia] ?></td>
                            <td><?= implode(', ', $obj_tabla_libros->mostrar_nombre_etiquetas($libro->etiquetas)) ?></td>
                            <td class='text-end'><?= number_format($libro->precio, 2, ',', '.'). ' €' ?></td>
                            
                            <!-- Columna de acciones -->
                            <td>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <a href="   .php?indice=<?=$indice ?>" title="Eliminar" class="btn btn-danger" onclick="return confirm('Confimar elimación del libro')"><i class="bi bi-trash-fill"></i></a>
                                <a href="editar.php?indice=<?=$indice ?>" title="Editar" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                <a href="mostrar.php?indice=<?=$indice ?>" title="Mostrar" class="btn btn-warning"><i class="bi bi-eye-fill"></i></a>
                            </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>   
                </tbody>
                <tfoot>
                    <tr><td colspan="6">Nº Registros <?= count($array_libros) ?></td></tr>
                </tfoot>
            </table>
        </div>
    </div>
    <br><br><br>

    <!-- Pie del documento -->
    <?php include 'views/partials/partial.footer.php';?>

    <!-- Bootstrap Javascript y popper -->
    <?php include 'views/layouts/layout.javascript.html';?>
    
 
</body>
</html>