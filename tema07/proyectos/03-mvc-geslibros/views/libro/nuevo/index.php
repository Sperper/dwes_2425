<!doctype html>
<html lang="es">

<head>
    <?php require_once 'template/layouts/head.layout.php'; ?>
    <title><?= $this->title ?> </title>
</head>

<body>
    <!-- Menú fijo superior -->
    <?php require_once 'template/partials/menu.partial.php' ?>

    <!-- Capa Principal -->
    <div class="container">
        <br><br><br><br>

        <!-- capa de mensajes -->
        <?php require_once 'template/partials/mensaje.partial.php' ?>

        <!-- Estilo card de bootstrap -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title"><?= $this->title ?></h5>
            </div>
            <div class="card-body">
                <!-- Formulario de alumnos  -->
                <form action="<?= URL ?>libro/create" method="POST">

                    <!-- titulo -->
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Titulo</label>
                        <input type="text" class="form-control" name="titulo">
                    </div>
                    <!-- precio -->
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="text" class="form-control" name="precio">
                    </div>
                    <!-- Precio -->
                    <div class="mb-3">
                        <label for="Precio" class="form-label">Stock</label>
                        <input type="date" class="form-control" name="Precio">
                    </div>
                    <!-- Fecha Edicion -->
                    <div class="mb-3">
                        <label for="fecha_edicion" class="form-label">Fecha Edicion</label>
                        <input type="text" class="form-control" name="fecha_edicion">
                    </div>

                    <!-- isbn -->
                    <div class="mb-3">
                        <label for="isbn" class="form-label">ISBN</label>
                        <input type="isbn" class="form-control" name="isbn">
                    </div>
                    <!-- autor -->
                    <div class="mb-3">
                        <label for="autor" class="form-label">Autor</label>
                        <input type="tel" class="form-control" name="autor">
                    </div>
                    <!-- Nacionalidad -->
                    <div class="mb-3">
                        <label for="nacionalidad" class="form-label">Nacionalidad</label>
                        <input type="text" class="form-control" name="nacionalidad">
                    </div>

                    <!-- Select Dinámico Cursos -->
                    <div class="mb-3">
                        <label for="curso" class="form-label">Curso</label>
                        <select class="form-select" name="id_curso">
                            <option selected disabled>Seleccione curso</option>
                            <!-- mostrar lista cucrsos -->
                            <?php foreach ($this->cursos as $indice => $data): ?>
                                <option value="<?= $indice ?>">
                                    <?= $data ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
            </div>
            <div class="card-footer">
                <!-- botones de acción -->
                <a class="btn btn-secondary" href="<?= URL ?>alumno" role="button">Cancelar</a>
                <button type="reset" class="btn btn-danger">Borrar</button>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
            </form>
            <!-- Fin formulario nuevo artículo -->
        </div>
        <br><br><br>

    </div>

    <!-- /.container -->

    <?php require_once 'template/partials/footer.partial.php' ?>
    <?php require_once 'template/layouts/javascript.layout.php' ?>

</body>

</html>