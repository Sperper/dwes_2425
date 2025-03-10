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
                <!-- Formulario de autores  -->
                <form action="<?= URL ?>autor/update/<?= $this->autor->id ?>" method="POST">

                    <!-- id oculto -->
                    <input type="number" class="form-control" name="id" value="<?= $this->autor->id ?>" hidden>

                    <!-- protección CSRF -->
                    <input type="hidden" name="csrf_token"
                        value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">

                    <!-- nombre -->
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control    
                            <?= (isset($this->error['nombre'])) ? 'is-invalid' : null ?>"
                            id="nombre" name="nombre"
                            placeholder="Introduzca nombre" value="<?= htmlspecialchars($this->autor->nombre) ?>"
                            required>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['nombre'] ??= null ?>
                        </span>
                    </div>

                    <!-- nacionalidad -->
                    <div class="mb-3">
                        <label for="nacionalidad" class="form-label">Nacionalidad</label>
                        <input type="text" class="form-control
                            <?= (isset($this->error['nacionalidad'])) ? 'is-invalid' : null ?>"
                            id="nacionalidad" name="nacionalidad"
                            placeholder="Introduzca nacionalidad" value="<?= htmlspecialchars($this->autor->nacionalidad) ?>"
                            required>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['nacionalidad'] ??= null ?>
                        </span>
                    </div>

                    <!-- email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control 
                        <?= (isset($this->error['email'])) ? 'is-invalid' : null ?>"
                            id="email" name="email"
                            placeholder="Introduzca email" value="<?= htmlspecialchars($this->autor->email) ?>"
                            required>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['email'] ??= null ?>
                        </span>
                    </div>

                    <!-- Fecha Nacimiento -->
                    <div class="mb-3">
                        <label for="fecha_nacimiento" class="form-label">Fecha Nacimiento</label>
                        <input type="date" class="form-control 
                            <?= (isset($this->error['fecha_nacimiento'])) ? 'is-invalid' : null ?>"
                            id="fecha_nacimiento" name="fecha_nacimiento"
                            value="<?= htmlspecialchars($this->autor->fecha_nac) ?>"
                            required>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['fecha_nacimiento'] ??= null ?>
                        </span>
                    </div>

                    <!-- Fecha Defuncion -->
                    <div class="mb-3">
                        <label for="fecha_defuncion" class="form-label">Fecha Defuncion</label>
                        <input type="date" class="form-control 
                            <?= (isset($this->error['fecha_defuncion'])) ? 'is-invalid' : null ?>"
                            id="fecha_defuncion" name="fecha_defuncion"
                            value="<?= htmlspecialchars($this->autor->fecha_def) ?>">
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['fecha_defuncion'] ??= null ?>
                        </span>
                    </div>

                    <!-- premios -->
                    <div class="mb-3">
                        <label for="premios" class="form-label">Premios</label>
                        <textarea class="form-control 
                            <?= (isset($this->error['premios'])) ? 'is-invalid' : null ?>"
                            id="premios" name="premios"
                            placeholder="Introduzca premios"><?= htmlspecialchars($this->autor->premios) ?></textarea>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['premios'] ??= null ?>
                        </span>
                    </div>

                    <!-- Botones de acción -->
                    <div class="card-footer">
                        <a class="btn btn-secondary" href="<?= URL ?>autor" role="button"
                            onclick="return confirm('¿Estás seguro de que deseas cancelar? Se perderán los datos ingresados.')">Cancelar</a>
                        <button type="reset" class="btn btn-danger">Borrar</button>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
                <!-- Fin formulario nuevo autor -->
            </div>
        </div>
        <br><br><br>

    </div>

    <!-- /.container -->

    <?php require_once 'template/partials/footer.partial.php' ?>
    <?php require_once 'template/layouts/javascript.layout.php' ?>

</body>

</html>
