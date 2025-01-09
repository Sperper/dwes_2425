<!DOCTYPE html>
<html lang="es">

<head>
    <!-- include head -->
    <?php include "views/layouts/layout.head.html" ?>
    <title>Nuevo Libro - GESLIBROS </title>
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <!-- include header -->
        <?php include "views/partials/partial.header.php" ?>

        <legend>Formulario Nuevo Libro</legend>

        <!-- Formulario Nuevo cliente -->

        <form action="create.php" method="POST">
            <!-- título -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" name="titulo">
            </div>

            <!-- autor -->
            <div class="mb-3">
                <label for="" class="form-label">Autor</label>
                <select class="form-select" name="autor">
                    <option selected disabled>Seleccione Autor</option>
                    <!-- generar lista dinámica -->
                    <?php foreach ($autores as $id => $autor): ?>
                        <option value="<?= $id ?>">
                            <?= $autor ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Editorial -->
            <div class="mb-3">
                <label for="" class="form-label">Editorial</label>
                <select class="form-select" name="editorial">
                    <option selected disabled>Seleccione Editorial</option>
                    <!-- generar lista dinámica -->
                </select>
            </div>

            <!-- precio -->
            <div class="mb-3">
                <label for="" class="form-label">Precio</label>
                <input type="number" class="form-control" aria-describedby="emailHelpId" step="0.01" placeholder="0.00" name="precio">
            </div>

            <!-- stock -->
            <div class="mb-3">
                <label for="" class="form-label">Unidades</label>
                <input type="number" class="form-control" aria-describedby="emailHelpId" value=0 name="unidades">
            </div>

            <!-- fecha_edicion -->
            <div class="mb-3">
                <label for="fecha_edicion" class="form-label">Fecha Edición</label>
                <input type="date" class="form-control" name="fecha_edicion">
            </div>

            <!-- isbn -->
            <div class="mb-3">
                <label for="isbn" class="form-label">Isbn</label>
                <input type="text" class="form-control" name="isbn">
            </div>

            <!-- lista checbox dinámica géneros -->
            <div class="mb-3">
                <label for="generos" class="form-label">Seleccione Géneros</label>
                <div class="form-control">
                    <!-- muestro el array categorías -->
                    generar dinámicamente la lista checkbox
                </div>
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
    <!-- include footer -->
    <?php include "partials/partial.footer.php" ?>

    <!-- Bootstrap Javascript y popper -->
    <!-- include javascript -->
    <?php include "layouts/layout.javascript.html" ?>

</body>

</html>