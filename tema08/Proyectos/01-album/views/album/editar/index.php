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

        <!-- capa errores -->
        <?php require_once 'template/partials/error.partial.php' ?>

        <!-- Estilo card de bootstrap -->
        <div class="card">
            <div class="card-header">
                <!-- Protección ataques XSS -->
                <h5 class="card-title"><?= htmlspecialchars($this->title) ?></h5>
            </div>
            <div class="card-body">
                <!-- Formulario de álbumes  -->
                <form action="<?= URL ?>album/update/<?= $this->id ?>/<?= $this->csrf_token ?>" method="POST" enctype="multipart/form-data">

                    <!-- protección CSRF -->
                    <input type="hidden" name="csrf_token"
                        value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">

                    <!-- Título -->
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" class="form-control
                            <?= (isset($this->error['titulo']))? 'is-invalid': null ?>" 
                            id="titulo" name="titulo"
                            placeholder="Introduzca título" value="<?= htmlspecialchars($this->album->titulo) ?>"
                            required>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['titulo'] ??= null ?>
                        </span>
                    </div>
                    <!-- Descripción -->
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control
                            <?= (isset($this->error['descripcion']))? 'is-invalid': null ?>" 
                            id="descripcion" name="descripcion"
                            placeholder="Introduzca descripción" required><?= htmlspecialchars($this->album->descripcion) ?></textarea>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['descripcion'] ??= null ?>
                        </span>   
                    </div>
                    <!-- Autor -->
                    <div class="mb-3">
                        <label for="autor" class="form-label">Autor</label>
                        <input type="text" class="form-control
                            <?= (isset($this->error['autor']))? 'is-invalid': null ?>" 
                            id="autor" name="autor"
                            placeholder="Introduzca autor" value="<?= htmlspecialchars($this->album->autor) ?>"
                            required>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['autor'] ??= null ?>
                        </span>
                    </div>
                    <!-- Fecha -->
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" class="form-control 
                            <?= (isset($this->error['fecha']))? 'is-invalid': null ?>" 
                            id="fecha" name="fecha"
                            value="<?= htmlspecialchars($this->album->fecha) ?>" required>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['fecha'] ??= null ?>
                        </span>
                    </div>
                    <!-- Lugar -->
                    <div class="mb-3">
                        <label for="lugar" class="form-label">Lugar</label>
                        <input type="text" class="form-control 
                            <?= (isset($this->error['lugar']))? 'is-invalid': null ?>" 
                            id="lugar" name="lugar"
                            placeholder="Introduzca lugar" value="<?= htmlspecialchars($this->album->lugar) ?>" 
                            required>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['lugar'] ??= null ?>
                        </span> 
                    </div>

                    <!-- Categorías -->
                    <div class="mb-3">
                        <label for="categoria_id" class="form-label">Categoría</label>
                        <select class="form-control 
                            <?= (isset($this->error['categoria_id']))? 'is-invalid': null ?>" 
                            id="categoria_id" name="categoria_id" required>
                            <option value="">Seleccione una categoría</option>
                            <?php foreach ($this->categorias as $id => $nombre): ?>
                                <option value="<?= $id ?>" <?= ($this->album->categoria_id == $id) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($nombre) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['categoria_id'] ??= null ?>
                        </span>
                    </div>

                    <!-- Carpeta -->
                    <div class="mb-3">
                        <label for="carpeta" class="form-label">Carpeta</label>
                        <input type="text" class="form-control
                            <?= (isset($this->error['carpeta']))? 'is-invalid': null ?>" 
                            id="carpeta" name="carpeta"
                            placeholder="Introduzca carpeta" value="<?= htmlspecialchars($this->album->carpeta) ?>"
                            readonly>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['carpeta'] ??= null ?>
                        </span>
                    </div>

                    <!-- Imágenes -->
                    <div class="mb-3">
                        <label for="imagenes" class="form-label">Imágenes</label>
                        <input type="file" class="form-control
                            <?= (isset($this->error['imagenes']))? 'is-invalid': null ?>" 
                            id="imagenes" name="imagenes[]" multiple accept="image/jpeg, image/png, image/gif">
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['imagenes'] ??= null ?>
                        </span>
                    </div>
            </div>
            <div class="card-footer">
                <!-- botones de acción -->
                <a class="btn btn-secondary" href="<?= URL ?>album" role="button" 
                onclick="return confirm('¿Estás seguro de que deseas cancelar? Se perderán los datos ingresados.')">Cancelar</a>
                <button type="reset" class="btn btn-danger">Borrar</button>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
            </form>
            <!-- Fin formulario editar álbum -->
        </div>
        <br><br><br>

    </div>

    <!-- /.container -->

    <?php require_once 'template/partials/footer.partial.php' ?>
    <?php require_once 'template/layouts/javascript.layout.php' ?>

</body>

</html>