<!DOCTYPE html>
<html lang="es">
<head>
    <?php include 'views/layouts/layout.head.html'; ?>
    <title>Panel de Control de Corredores - Home </title>
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
                        <th>Corredor</th>
                        <th>Ciudad</th>
                        <th>Sexo</th>
                        <th>Email</th>
                        <th>DNI</th>
                        <th>Categoría</th>
                        <th>Curso</th>
                        <th class='text-end'>Edad</th>
                        <!-- columna de acciones -->
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Mostramos cuerpo de la tabla -->
                    <?php while ($corredor = $corredores->fetch_object()): ?>
                        <tr class="align-middle">
                            <!-- Detalles de artículos -->
                            <td><?= $corredor->id ?></td>
                            <td><?= $corredor->corredor?></td>
                            <td><?= $corredor->ciudad ?></td>
                            <td><?= $corredor->sexo ?></td>
                            <td><?= $corredor->email ?></td>
                            <td><?= $corredor->dni ?></td>
                            <td><?= $corredor->club ?></td>
                            <td><?= $corredor->categoria ?></td>
                            <td class='text-end'><?= $corredor->edad ?></td>
                            
                            <!-- Columna de acciones -->
                            <td>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <a href="eliminar.php?id=<?= $corredor->id ?>" title="Eliminar" class="btn btn-danger" onclick="return confirm('Confimar elimación del corredor')"><i class="bi bi-trash-fill"></i></a>
                                <a href="editar.php?id=<?= $corredor->id ?>" title="Editar" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                <a href="mostrar.php?id=<?= $corredor->id ?>" title="Mostrar" class="btn btn-warning"><i class="bi bi-eye-fill"></i></a>
                            </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>   
                </tbody>
                <tfoot>
                    <tr><td colspan="6">Nº de  corredores: <?= $corredores->num_rows ?></td></tr>
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