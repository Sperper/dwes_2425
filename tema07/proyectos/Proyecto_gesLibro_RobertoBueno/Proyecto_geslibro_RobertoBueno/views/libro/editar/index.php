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
                <!-- Enviar al controlador update con el id del libro -->
                <form action="<?= URL ?>libro/update/<?= $this->id ?>" method="POST">

                    <!-- id oculto -->
                    <!-- Tengo que pasar el id oculto para que el controlador pueda validar doblemente el id -->
                    <input type="number" class="form-control" name="id" value="<?= $this->libro->id ?>" hidden>

                    <!-- titulo -->
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Titulo</label>
                        <input type="text" class="form-control" name="titulo" value="<?= $this->libro->titulo ?>">
                    </div>
                    <!-- Select Dinámico Autores -->
                    <div class="mb-3">
                        <label for="autor" class="form-label">Autor</label>
                        <select class="form-select" name="autor">
                            <option selected disabled>Seleccione Autor</option>
                            <!-- mostrar lista Autor -->
                            <?php foreach ($this->autores as $indice => $data): ?>
                                <option value="<?= $indice ?>" 
                                    <?= ($indice == $this->libro->autor_id) ? 'selected' : '' ?>>
                                    <?= $data ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Select Dinámico Editorial -->
                    <div class="mb-3">
                        <label for="editorial" class="form-label">Editorial</label>
                        <select class="form-select" name="editorial">
                            <option selected disabled>Seleccione Editorial</option>
                            <!-- mostrar lista Editorial -->
                            <?php foreach ($this->editoriales as $indice => $data): ?>
                                <option value="<?= $indice ?>" 
                                    <?= ($indice == $this->libro->editorial_id) ? 'selected' : '' ?>>
                                    <?= $data ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Precio -->
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="text" class="form-control" name="precio" value="<?= $this->libro->precio ?>">
                    </div>
                    <!-- unidades -->
                    <div class="mb-3">
                        <label for="unidades" class="form-label">Unidades</label>
                        <input type="text" class="form-control" name="unidades" value="<?= $this->libro->stock ?>">
                    </div>

                    <!-- fecha_edicion -->
                    <div class="mb-3">
                        <label for="fecha_edicion" class="form-label">Fecha Edición</label>
                        <input type="date" class="form-control" name="fecha_edicion" value="<?= $this->libro->fecha_edicion ?>">
                    </div>
                    <!-- isbn -->
                    <div class="mb-3">
                        <label for="isbn" class="form-label">Isbn</label>
                        <input type="tel" class="form-control" name="isbn" value="<?= $this->libro->isbn ?>">
                    </div>
                    
                    <!-- lista checbox dinámica géneros -->

                    <div class="mb-3">
                        <label for="generos" class="form-label">Seleccione Géneros</label>
                        <div class="form-control">
                            <!-- muestro el array generos -->
                            <?php foreach ($this->generos as $indice => $data): ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="generos[]" value="<?= $indice ?>"
                                    <?= (in_array($indice, $this->libro->generos)) ? 'checked' : '' ?>>
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
                <button type="submit" class="btn btn-primary">Actualizar</button>
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