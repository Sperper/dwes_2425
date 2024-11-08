<!DOCTYPE html>
<html lang="es">

<head>
    <!-- cargar head.html -->
    <?php include 'views/layouts/head.html'; ?>
    <title>Gestión de Artículos - Home </title>
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <!-- cargar partial.header.php -->
        <?php include 'views/partials/partial.header.php'; ?>



        <!-- Menú principal -->
        <!-- cargar partial.menu.php -->
        <?php include 'views/partials/partial.menu.php'; ?>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <!-- Mostramos el encabezado de la tabla -->
                    <th>ID</th>
                    <th>Descripción</th>
                    <th>Modelo</th>
                    <th>Categoría</th>
                    <th class="text-end">Unidades</th>
                    <th class="text-end">Precio</th>
                    <th>Acciones</th>

                </thead>
                <tbody>
                    <!-- Mostramos cuerpo de la tabla -->

                    <?php foreach ($tabla as $key => $registro): ?>
                        <tr>
                            <td><?= $registro['id'] ?></td>
                            <td><?= $registro['descripcion'] ?></td>
                            <td><?= $registro['modelo'] ?></td>
                            <td><?= $registro['categoria'] ?></td>
                            <td class="text-end"><?= number_format($registro['unidades'], 2, ',', '.'); ?></td>
                            <td class="text-end"><?= number_format($registro['precio'], 2, ',', '.'); ?> €</td>

                            <!-- botones de accion -->
                            <td>
                                <!-- botón de eliminar -->
                                <a href="delete.php?id=<?= $registro['id'] ?>"><i class="bi bi-trash-fill"></i></a>

                                <!-- botón de editar -->
                                <a href="editar.php?id=<?= $registro['id'] ?>"><i class="bi bi-pencil-square"></i></a>

                                <!-- botón de mostrar -->
                                <a href="mostrar.php?id=<?= $registro['id'] ?>"><i class="bi bi-eye-fill"></i></a>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <!-- Mostrar el número de registros de la tabla -->
                    <td>Nº Registros: <?= count($tabla) ?></td>
                </tfoot>
            </table>
        </div>
    </div>
    <br><br><br>

    <!-- Pie del documento -->
    <!-- cargar partial.footer.php -->
    <?php include 'views/partials/partial.footer.php'; ?>

    <!-- Bootstrap Javascript y popper -->
    <!-- cargar javascript.php -->
    <?php include 'views/layouts/javascript.html'; ?>


</body>

</html>