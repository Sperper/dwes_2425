<!DOCTYPE html>
<html lang="es">
<head>
    <?php include 'views/layouts/layout.head.html'; ?>
    <title>Panel de Control de Clientes - GESBANK </title>
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
                        <th>Cliente</th>
                        <th>Ciudad</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>DNI</th>
                        <th class='text-end'>Saldo</th>
                        <!-- columna de acciones -->
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Mostramos cuerpo de la tabla -->
                    <?php while ($cliente = $stmt_clientes->fetch()): ?>
                        <tr class="align-middle">
                            <!-- Detalles de artículos -->
                            <td><?= $cliente->id ?></td>
                            <td><?= $cliente->cliente ?></td>
                            <td><?= $cliente->ciudad ?></td>
                            <td><?= $cliente->email ?></td>
                            <td><?= $cliente->telefono ?></td>
                            <td><?= $cliente->dni ?></td>
                            <td class='text-end'><?= number_format($cliente->saldo, 2, ',', '.') ?>€</td>                               
                            <!-- Columna de acciones -->
                            <td>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <a href="eliminar.php?id=<?= $cliente->id ?>" title="Eliminar" class="btn btn-danger" onclick="return confirm('Confimar elimación del cliente')"><i class="bi bi-trash-fill"></i></a>
                                <a href="editar.php?id=<?= $cliente->id ?>" title="Editar" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                <a href="mostrar.php?id=<?= $cliente->id ?>" title="Mostrar" class="btn btn-warning"><i class="bi bi-eye-fill"></i></a>
                            </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>   
                </tbody>
                <tfoot>
                    <tr><td colspan="6">Nº clientes <?= $stmt_clientes->rowCount() ?></td></tr>
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