<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/layout.head.html'; ?>
    <title>Editar Cliente - GESBANK </title>
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <?php include 'views/partials/partial.header.php'; ?>

        <legend>Formulario Edición Cliente</legend>

        <!-- Formulario Editar cuenta -->

        <form action="update.php?id=<?= $id ?>" method="POST">

            <!-- Num_cuenta -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Num_cuenta</label>
                <input type="text" class="form-control" name="num_cuenta" value="<?= $cuenta->num_cuenta ?>" readonly>
            </div>
            <!-- Select Dinámico Clientes -->
            <div class="mb-3">
                <label for="curso" class="form-label">Cliente</label>
                <select class="form-select" name="id_cliente">
                    <!-- mostrar lista clientes -->
                    <?php foreach ($clientes as $indice => $data): ?>
                        <option value="<?= $indice ?>"
                        <?= ($cuenta->id_cliente == $indice) ? 'selected' : null ?>
                        >
                            <?= $data ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- Fecha_alta -->
            <div class="mb-3">
                <label for="apellidos" class="form-label">Fecha_alta</label>
                <input type="text" class="form-control" name="fecha_alta" value="<?= $cuenta->fecha_alta ?>">
            </div>
            <!-- Fecha_ul_mov -->
            <div class="mb-3">
                <label for="ciudad" class="form-label">Fecha_ul_mov</label>
                <input type="text" class="form-control" name="fecha_ul_mov" value="<?= $cuenta->fecha_ul_mov ?>">
            </div>
            <!-- Num_movtos -->
            <div class="mb-3">
                <label for="telefono" class="form-label">Num_movtos</label>
                <input type="tel" class="form-control" name="num_movtos" value="<?= $cuenta->num_movtos ?>">
            </div>
            <!-- Saldo -->
            <div class="mb-3">
                <label for="dni" class="form-label">Saldo</label>
                <input type="text" class="form-control" name="saldo" value="<?= $cuenta->saldo ?>">
            </div>

            <!-- botones de acción -->
            <a class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Borrar</button>
            <button type="submit" class="btn btn-primary">Actualizar</button>

        </form>
        <!-- Fin formulario nuevo artículo -->
    </div>
    <br><br><br>

    <!-- Pie del documento -->
    <?php include 'views/partials/partial.footer.php'; ?>

    <!-- Bootstrap Javascript y popper -->
    <?php include 'views/layouts/layout.javascript.html'; ?>


</body>

</html>