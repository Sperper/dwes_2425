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
                <form action="<?= URL ?>autor/create" method="POST">

                    <!-- protección CSRF -->
                    <input type="hidden" name="csrf_token"
                        value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">

                    <!-- titulo -->
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Titulo</label>
                        <input type="text" class="form-control    
                            <?= (isset($this->error['nombre'])) ? 'is-invalid' : null ?>"
                            id="nombre" name="nombre"
                            placeholder="Introduzca titulnombreo" value="<?= htmlspecialchars($this->autor->nombre) ?>"
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

                    <!-- fecha_nac -->
                    <div class="mb-3">
                        <label for="fecha_nac" class="form-label">Fecha de Nacimiento</label>
                        <input type="date" class="form-control    
                            <?= (isset($this->error['fecha_nac'])) ? 'is-invalid' : null ?>"
                            id="fecha_nac" name="fecha_nac"
                            placeholder="Introduzca fecha de nacimiento" value="<?= htmlspecialchars($this->autor->fecha_nac) ?>"
                            required>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['fecha_nac'] ??= null ?>
                        </span>
                    </div>

                    <!-- fecha_def -->
                    <div class="mb-3">
                        <label for="fecha_def" class="form-label">Fecha de Defunción</label>
                        <input type="date" class="form-control    
                            <?= (isset($this->error['fecha_def'])) ? 'is-invalid' : null ?>"
                            id="fecha_def" name="fecha_def"
                            placeholder="Introduzca fecha de defunción" value="<?= htmlspecialchars($this->autor->fecha_def) ?>"
                            required>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['fecha_def'] ??= null ?>
                        </span>
                    </div>

                    <!-- premios -->
                    <div class="mb-3">
                        <label for="premios" class="form-label">Premios</label>
                        <input type="text" class="form-control    
                            <?= (isset($this->error['premios'])) ? 'is-invalid' : null ?>"
                            id="premios" name="premios"
                            placeholder="Introduzca premios" value="<?= htmlspecialchars($this->autor->premios) ?>"
                            required>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['premios'] ??= null ?>
                        </span>
                    </div>

            </div>
            <div class="card-footer">
                <!-- botones de acción -->
                <a class="btn btn-secondary" href="<?= URL ?>autor" role="button">Cancelar</a>
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