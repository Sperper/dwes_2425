<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/layout.head.html'; ?>
    <title>Nuevo Cuenta - GESBANK </title>
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <?php include 'views/partials/partial.header.php'; ?>

        <legend>Formulario Nueva Cuenta</legend>

        <!-- Formulario Nuevo cliente -->

        <form action="create.php" method="POST">

            <!-- Select Dinámico Clientes -->
            <div class="mb-3">
                <label for="curso" class="form-label">Cliente</label>
                <select class="form-select" name="id_cliente">
                    <option selected disabled>Seleccione un cliente</option>
                    <!-- mostrar lista clientes -->
                    <?php foreach ($clientes as $indice => $data): ?>
                        <option value="<?= $indice ?>">
                            <?= $data ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Cuenta -->
            <div class="mb-3">
                <label for="" class="form-label">Numero de cuenta</label>
                <input type="text" class="form-control" name="num_cuenta" minlength="20" maxlength="20">
            </div>

            <!-- Fecha alta -->
            <!-- Establece la fecha hora actual -->
            <div class="mb-3">
                <label for="" class="form-label">Fecha alta</label>
                <input type="datetime-local" class="form-control" name="fecha_alta" value="<?= date('Y-m-d H:i:s'); ?>">
            </div>

            <!-- Fecha ult mov -->
            <div class="mb-3">
                <label for="" class="form-label">Fecha Último Movimiento</label>
                <input type="datetime-local" class="form-control" name="fecha_ul_mov" readonly>
            </div>

            <!-- num_movtos -->
            <div class="mb-3">
                <label for="" class="form-label">Nº de Movimientos</label>
                <input type="text" class="form-control" name="num_movtos" id="" placeholder="0" readonly>
            </div>

            <!-- Saldo -->
            <div class="mb-3">
                <label for="" class="form-label">Saldo</label>
                <input type="text" class="form-control" name="saldo" id="" placeholder="0">
            </div>


            <!-- botones de acción -->
            <a class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Borrar</button>
            <button type="submit" class="btn btn-primary">Enviar</button>

        </form>
        <!-- Fin formulario nuevo cliente -->
    </div>
    <br><br><br>

    <!-- Pie del documento -->
    <?php include 'views/partials/partial.footer.php'; ?>

    <!-- Bootstrap Javascript y popper -->
    <?php include 'views/layouts/layout.javascript.html'; ?>


</body>

</html>