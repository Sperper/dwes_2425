<!DOCTYPE html>
<html lang="es">

<head>
    <!-- cargar head.html -->
    <?php include 'views/layouts/head.html'; ?>
    <title>Artículos - Mostrar </title>
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- cargar partial.headr.php -->
        <?php include 'views/partials/partial.header.php'; ?>

        <legend>Mostrar Artículo</legend>

        <form>
            <!-- id -->
            <div class="mb-3">
                <label for="id" class="form-label">Id</label>
                <input type="number" class="form-control" id="id" name="id" value="<?= $registro['id'] ?>" readonly>

            </div>


            <!-- Descripción -->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion"
                    value="<?= $registro['descripcion'] ?>" readonly>
            </div>

            <!-- Modelo -->
            <div class="mb-3">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" class="form-control" id="modelo" name="modelo" value="<?= $registro['modelo'] ?>"
                    readonly>
            </div>

            <!-- Categoria -->
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria</label>
                <input type="text" class="form-control" id="categoria" name="categoria"
                    value="<?= $registro['categoria'] ?>" readonly>
            </div>


            <!-- Unidades -->
            <div class="mb-3">
                <label for="unidades" class="form-label">Unidades</label>
                <input type="number" class="form-control" step="0.01" id="unidades" name="unidades"
                    value=<?= $registro['unidades'] ?> readonly>
            </div>

            <!-- Precio -->
            <div class="mb-3">
                <label for="precio" class="form-label">Precio (€)</label>
                <input type="number" class="form-control" step="0.01" id="precio" name="precio"
                    value=<?= $registro['precio'] ?> readonly>
            </div>

            <!-- botones de acción -->
            <a class="btn btn-secondary" href="index.php" role="button">Volver</a>

        </form>

        <br><br><br>

        <!-- Pie del documento -->
        <!-- cargar partial.footer.php -->
        <?php include 'views/partials/partial.footer.php'; ?>

        <!-- Bootstrap Javascript y popper -->
        <!-- cargar javascript.html -->
        <?php include 'views/layouts/javascript.html'; ?>

</body>

</html>