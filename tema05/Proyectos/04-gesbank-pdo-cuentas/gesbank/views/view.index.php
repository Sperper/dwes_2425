<!DOCTYPE html>
<html lang="es">
<head>
    <?php include 'views/layouts/layout.head.html'; ?>
    <title>Panel de Control de Cuentas - GESBANK </title>
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
                        <th>Num_cuenta</th>
                        <th>Cliente</th>
                        <th>Fecha Alta</th>
                        <th>Último Mov</th>
                        <th class='text-end'>Nº Mvtos</th>
                        <th class='text-end'>Saldo</th>
                        <!-- columna de acciones -->
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Mostramos cuerpo de la tabla -->
                    <?php while ($cuenta = $stmt_cuentas->fetch()): ?>
                        <tr class="align-middle">
                            <!-- Detalles de artículos -->
                            <td><?= $cuenta->id ?></td>
                            <td><?= $cuenta->num_cuenta ?></td>
                            <td><?= $cuenta->cliente ?></td>
                            <td><?= date('d/m/Y', strtotime($cuenta->fecha_alta)) ?></td>
                            <td><?= date('d/m/Y', strtotime($cuenta->fecha_ul_mov)) ?></td>
                            <td class='text-end'><?= $cuenta->num_movtos ?></td>
                            <td class='text-end'><?= number_format($cuenta->saldo, 2, ',', '.') ?>€</td>                               
                            <!-- Columna de acciones -->
                            <td>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <a href="eliminar.php?id=<?= $cuenta->id ?>" title="Eliminar" class="btn btn-danger" onclick="return confirm('Confimar elimación de la cuenta')"><i class="bi bi-trash-fill"></i></a>
                                <a href="editar.php?id=<?= $cuenta->id ?>" title="Editar" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                <a href="mostrar.php?id=<?= $cuenta->id ?>" title="Mostrar" class="btn btn-warning"><i class="bi bi-eye-fill"></i></a>
                            </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>   
                </tbody>
                <tfoot>
                    <tr><td colspan="8">Nº cuentas <?= $stmt_cuentas->rowCount() ?></td></tr>
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