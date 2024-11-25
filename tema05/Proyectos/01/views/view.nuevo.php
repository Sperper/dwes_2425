<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/layout.head.html'; ?>
    <title>Nuevo Libro - CRUD Libros </title>
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <?php include 'views/partials/partial.header.php'; ?>

        <legend>Formulario Nuevo Libro</legend>

        <!-- Formulario Nuevo libro -->

        <form action="create.php" method="POST">

            <!-- id -->
            <div class="mb-3">
                <label for="id" class="form-label">Id</label>
                <input type="text" class="form-control" name="id">
            </div>

            <!-- titulo -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Titulo</label>
                <input type="text" class="form-control" name="titulo">
            </div>

            <!-- autor -->
            <div class="mb-3">
                <label for="autor" class="form-label">Autor</label>
                <input type="text" class="form-control" name="autor">
            </div>

            <!-- Editorial -->
            <div class="mb-3">
                <label for="editorial" class="form-label">Editorial</label>
                <input type="text" class="form-control" name="editorial">
            </div>

            <!-- Edición -->
            <div class="mb-3">
                <label for="edicion" class="form-label">Edicion</label>
                <input type="text" class="form-control" name="fecha_edicion">
            </div>

            <!-- Select Dinámico Materias -->
            <div class="mb-3">
                <label for="materia" class="form-label">Materias</label>
                <select class="form-select" name="materia" id="materia">
                    <option selected disabled>Seleccione una Materia</option>
                    <!-- mostrar lista marcas -->
                    <?php foreach ($materias as $indice => $data): ?>
                        <option value="<?= $indice ?>">
                            <?= $data ?>
                        </option>
                    <?php endforeach; ?>
                </select>

            </div>

            <!-- lista checbox dinámica etiquetas -->
            <div class="mb-3">
                <label for="etiquetas" class="form-label">Seleccione las Etiquetas</label>
                <div class="form-control">
                    <!-- muestro el array etiquetas -->
                    <?php foreach ($etiquetas as $indice => $data): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="etiquetas[]" value="<?= $indice ?>">
                            <label class="form-check-label" for="">
                                <?= $data ?>
                            </label>
                        </div>
                    <?php endforeach; ?>

                </div>

            </div>

            <!-- Precio -->
            <div class="mb-3">
                <label for="precio" class="form-label">Precio (€)</label>
                <input type="number" class="form-control" name="precio" step="0.01">
            </div>


    </div>

    <!-- botones de acción -->
    <a class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
    <button type="reset" class="btn btn-danger">Borrar</button>
    <button type="submit" class="btn btn-primary">Enviar</button>

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