<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/layout.head.html'; ?>
    <title>Mostrar Cuenta - CRUD Cuentas </title>
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <?php include 'views/partials/partial.header.php'; ?>

        <legend>Formulario Mostrar Cuenta</legend>

        <!-- Formulario Nuevo cuenta -->

        <form>

            <!-- Num_cuenta -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Num_cuenta</label>
                <input type="text" class="form-control" name="num_cuenta" value="<?= $cuenta->num_cuenta ?>" disabled>
            </div>
            <!-- Cliente-->
            <div class="mb-3">
                <label for="nombre" class="form-label">Cliente</label>
                <input type="text" class="form-control" name="cliente" value="<?= $cuenta->cliente ?>" disabled>
            </div>
            <!-- Fecha_alta -->
            <div class="mb-3">
                <label for="apellidos" class="form-label">Fecha_alta</label>
                <input type="text" class="form-control" name="fecha_alta" value="<?= $cuenta->fecha_alta ?>" disabled>
            </div>
            <!-- Fecha_ul_mov -->
            <div class="mb-3">
                <label for="ciudad" class="form-label">Fecha_ul_mov</label>
                <input type="text" class="form-control" name="fecha_ul_mov" value="<?= $cuenta->fecha_ul_mov ?>" disabled>
            </div>
            <!-- Num_movtos -->
            <div class="mb-3">
                <label for="telefono" class="form-label">Num_movtos</label>
                <input type="tel" class="form-control" name="num_movtos" value="<?= $cuenta->num_movtos ?>" disabled>
            </div>
            <!-- Saldo -->
            <div class="mb-3">
                <label for="dni" class="form-label">Saldo</label>
                <input type="text" class="form-control" name="saldo" value="<?= $cuenta->saldo ?>" disabled>
            </div>

            <!-- botones de acción -->
            <a class="btn btn-secondary" href="index.php" role="button">Volver</a>

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