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
                <!-- Formulario de libros  -->
                <form action="<?= URL ?>libro/create" method="POST">

                    <!-- titulo -->
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Titulo</label>
                        <input type="text" class="form-control" name="titulo">
                    </div>
                    <!-- Select Dinámico autores -->
                    <div class="mb-3">
                        <label for="autor" class="form-label">Autor</label>
                        <select class="form-select" name="autor" required>
                            <option selected disabled>Seleccione Autor</option>
                            <!-- mostrar lista autores -->
                            <?php foreach ($this->autores as $indice => $data): ?>
                                <option value="<?= $indice ?>">
                                    <?= $data ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Select Dinámico editorial -->
                    <div class="mb-3">
                        <label for="editorial" class="form-label">Editorial</label>
                        <select class="form-select" name="editorial" required>
                            <option selected disabled>Seleccione Editorial</option>
                            <!-- mostrar lista cucrsos -->
                            <?php foreach ($this->editoriales as $indice => $data): ?>
                                <option value="<?= $indice ?>">
                                    <?= $data ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- precio -->
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" class="form-control" name="precio" step="0.01" placeholder="0.00">
                    </div>

                    <!-- unidades -->
                    <div class="mb-3">
                        <label for="unidades" class="form-label">Unidades</label>
                        <input type="number" class="form-control" name="unidades" placeholder="0" step="1">
                    </div>
                    <!-- fecha_edicion -->
                    <div class="mb-3">
                        <label for="fecha_edicion" class="form-label">Fecha Edición</label>
                        <input type="date" class="form-control" name="fecha_edicion">
                    </div>
                    <!-- isbn -->
                    <div class="mb-3">
                        <label for="isbn" class="form-label">Isbn</label>
                        <input type="number" class="form-control" name="isbn">
                    </div>

                    <!-- lista checbox dinámica géneros -->

                    <div class="mb-3">
                        <label for="generos_id" class="form-label">Seleccione Géneros</label>
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
                <a class="btn btn-secondary" href="<?= URL ?>libro" role="button">Cancelar</a>
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