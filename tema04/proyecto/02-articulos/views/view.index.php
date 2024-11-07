<!DOCTYPE html>
<html lang="es">
<head>
    <?php include 'views/layouts/layout.head.html'; ?>
    <title>Gestión de Artículos - Home </title>
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
                        <th>Descripción</th>
                        <th>Modelo</th>
                        <th>Marca</th>
                        <th>Categorías</th>
                        <th class='text-end'>Unidades</th>
                        <th class='text-end'>Precio</th>
                        <!-- columna de acciones -->
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Mostramos cuerpo de la tabla -->
                    <?php foreach ($array_articulos as $indice => $articulo): ?>
                        <tr>
                            <!-- Detalles de artículos -->
                            <td><?= $articulo->getId() ?></td>
                            <td><?= $articulo->getDescripcion() ?></td>
                            <td><?= $articulo->getModelo() ?></td>
                            <td><?= $marcas[$articulo->getMarca()] ?></td>
                            <td><?= implode(', ', $obj_tabla_articulos->mostrar_nombre_categorias($articulo->getCategorias())) ?></td>
                            <td class='text-end'><?= number_format($articulo->getUnidades(), 1, ',', '.') ?></td>
                            <td class='text-end'><?= number_format($articulo->getPrecio(), 2, ',', '.'). ' €' ?></td>
                            
                            <!-- Columna de acciones -->
                            <td>
                                <a href="eliminar.php?indice=<?=$indice?>" title="Eliminar" class="btn btn-danger"><i class="bi bi-trash-fill" onclick="return confirm('Seguro que desea eliminar el  artículo')"></i></a>
                                <a href="editar.php?indice=<?=$indice?>" title="Editar" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                <a href="mostrar.php?indice=<?=$indice?>" title="Mostrar" class="btn btn-warning"><i class="bi bi-eye-fill"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>   
                </tbody>
                <tfoot>
                    <tr><td colspan="6">Nº Registros <?= count($array_articulos) ?></td></tr>
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