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
                        <input type="number" class="form-control" name="precio">
                    </div>
                    <!-- Precio -->
                    <div class="mb-3">
                        <label for="Precio" class="form-label">Stock</label>
                        <input type="number" class="form-control" name="stock">
                    </div>
                    <!-- Fecha Edicion -->
                    <div class="mb-3">
                        <label for="fecha_edicion" class="form-label">Fecha Edicion</label>
                        <input type="date" class="form-control" name="fecha_edicion">
                    </div>

                    <!-- isbn -->
                    <div class="mb-3">
                        <label for="isbn" class="form-label">ISBN</label>
                        <input type="text" class="form-control" name="isbn">
                    </div>

                    <!-- Select Dinámico Editoriales -->
                    <div class="mb-3">
                        <label for="curso" class="form-label">Editoriales</label>
                        <select class="form-select" name="id_editorial">
                            <option selected disabled>Seleccione editoriales</option>
                            <!-- mostrar lista editoriales -->
                            <?php foreach ($this->editoriales as $indice => $data): ?>
                                <option value="<?= $indice ?>">
                                    <?= $data ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Select Dinámico Autores -->
                    <div class="mb-3">
                        <label for="curso" class="form-label">Autor</label>
                        <select class="form-select" name="id_autor">
                            <option selected disabled>Seleccione autor</option>
                            <!-- mostrar lista cucrsos -->
                            <?php foreach ($this->autores as $indice => $data): ?>
                                <option value="<?= $indice ?>">
                                    <?= $data ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Checkbox Dinámico Generos -->
                    <div class="mb-3">
                        <label for="etiquetas" class="form-label">Seleccione los Generos</label>
                        <div class="form-control">
                            <!-- muestro el array generos -->
                            <?php foreach ($this->generos as $indice => $data): ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="generos[]" value="<?= $indice ?>">
                                    <label class="form-check-label" for="">
                                        <?= $data ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>

                        </div>
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