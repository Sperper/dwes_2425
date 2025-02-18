<!doctype html>
<html lang="es">

<head>
    <?php require_once 'template/layouts/head.layout.php'; ?>
    <title><?= $this->title ?> </title>
</head>

<body>
    <!-- Menú fijo superior -->
    <?php require_once 'template/partials/menu.auth.partial.php' ?>

    <!-- Capa Principal -->
    <div class="container">
        <br><br><br><br>

        <!-- capa de mensajes -->
        <?php require_once 'template/partials/mensaje.partial.php' ?>

        <!-- Estilo card de bootstrap -->
        <div class="card">
            <div class="card-header">
                <!-- Protección ataques XSS -->
                <h5 class="card-title"><?= htmlspecialchars($this->title) ?></h5>
            </div>
            <div class="card-body">
                <!-- Formulario de alumnos  -->
                <form action="<?= URL ?>libro/update/<?= $this->id ?>/<?= $this->csrf_token ?>" method="POST">

                    <!-- id oculto -->
                    <input type="number" class="form-control" name="id" value="<?= $this->libro->id ?>" hidden>

                    <!-- protección CSRF -->
                    <input type="hidden" name="csrf_token"
                        value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">

                    <!-- titulo -->
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Titulo</label>
                        <input type="text" class="form-control    
                            <?= (isset($this->error['titulo'])) ? 'is-invalid' : null ?>"
                            id="titulo" name="titulo"
                            placeholder="Introduzca titulo" value="<?= htmlspecialchars($this->libro->titulo) ?>"
                            required>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['titulo'] ??= null ?>
                        </span>
                    </div>

                    <!-- Precio -->
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" class="form-control
                            <?= (isset($this->error['precio'])) ? 'is-invalid' : null ?>"
                            id="precio" name="precio"
                            placeholder="Introduzca precio" value="<?= htmlspecialchars($this->libro->precio) ?>"
                            required>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['precio'] ??= null ?>
                        </span>
                    </div>

                    <!-- Stock -->
                    <div class="mb-3">
                        <label for="Precio" class="form-label">Stock</label>
                        <input type="number" class="form-control 
                        <?= (isset($this->error['stock'])) ? 'is-invalid' : null ?>"
                            id="stock" name="stock"
                            placeholder="Introduzca stock" value="<?= htmlspecialchars($this->libro->stock) ?>"
                            required>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['stock'] ??= null ?>
                        </span>
                    </div>

                    <!-- Fecha Edicion -->
                    <div class="mb-3">
                        <label for="fecha_edicion" class="form-label">Fecha Edicion</label>
                        <input type="date" class="form-control 
                            <?= (isset($this->error['fecha_edicion'])) ? 'is-invalid' : null ?>"
                            id="fecha_edicion" name="fecha_edicion"
                            value="<?= htmlspecialchars($this->libro->fecha_edicion) ?>"
                            required>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['fecha_edicion'] ??= null ?>
                        </span>
                    </div>

                    <!-- isbn -->
                    <div class="mb-3">
                        <label for="isbn" class="form-label">ISBN</label>
                        <input type="text" class="form-control 
                            <?= (isset($this->error['isbn'])) ? 'is-invalid' : null ?>"
                            id="isbn" name="isbn"
                            placeholder="Introduzca isbn" value="<?= htmlspecialchars($this->libro->isbn) ?>"
                            required pattern="^[0-9]{13}$" title="13 dígitos">
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['isbn'] ??= null ?>
                        </span>
                    </div>

                    <!-- Select Dinámico Editoriales -->
                    <div class="mb-3">
                        <label for="curso" class="form-label">Editoriales</label>
                        <select class="form-select
                        <?= (isset($this->error['id_editorial'])) ? 'is-invalid' : null ?>"
                            id="id_editorial" name="id_editorial" required>
                            <option selected disabled>Seleccione editoriales</option>
                            <!-- mostrar lista editoriales -->
                            <?php foreach ($this->editoriales as $indice => $data): ?>
                                <option value="<?= $indice ?>" <?= $this->libro->editorial_id == $indice ? 'selected' : '' ?>>
                                    <?= $data ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['id_editorial'] ??= null ?>
                        </span>
                    </div>

                    <!-- Select Dinámico Autores -->
                    <div class="mb-3">
                        <label for="curso" class="form-label">Autor</label>
                        <select class="form-select
                        <?= (isset($this->error['id_autor'])) ? 'is-invalid' : null ?>"
                            id="id_autor" name="id_autor" required>
                            <option selected disabled   >Seleccione autor</option>
                            <!-- mostrar lista cucrsos -->
                            <?php foreach ($this->autores as $indice => $data): ?>
                                <option value="<?= $indice ?>" <?= $this->libro->autor_id == $indice ? 'selected' : '' ?>>
                                    <?= $data ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['id_editorial'] ??= null ?>
                        </span>
                    </div>

                    <!-- Checkbox Dinámico Generos -->
                    <div class="mb-3">
                        <label for="etiquetas" class="form-label">Seleccione los Generos</label>
                        <div class="form-control">
                            <!-- muestro el array generos -->
                            <?php foreach ($this->generos as $indice => $data): ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="generos[]" value="<?= $indice ?>"
                                        <?php if (in_array($indice, explode(',', $this->libro->generos_id))) echo 'checked' ?>>
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
                <a class="btn btn-secondary" href="<?= URL ?>libro" role="button"
                    onclick="return confirm('¿Estás seguro de que deseas cancelar? Se perderán los datos ingresados.')">Cancelar</a>
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