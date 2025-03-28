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
                <!-- Formulario de usuarios  -->
                <form action="<?= URL ?>usuario/update/<?= htmlspecialchars($this->usuario->id) ?>" method="POST">

                    <!-- id oculto -->
                    <input type="number" class="form-control" name="id" value="<?= htmlspecialchars($this->usuario->id) ?>" hidden readonly>

                    <!-- protección CSRF -->
                    <input type="hidden" name="csrf_token"
                        value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">

                    <!-- campo name -->
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                        <div class="col-md-6">
                            <input id="name" type="text"
                                class="form-control <?= (isset($this->error['name'])) ? 'is-invalid' : null ?>"
                                name="name" value="<?= htmlspecialchars($this->usuario->name) ?>" required
                                autocomplete="name" autofocus disabled>
                            <!-- control de errores -->
                            <span class="form-text text-danger" role="alert">
                                <?= $this->error['name'] ?? '' ?>
                            </span>
                        </div>
                    </div>

                    <!-- campo email -->
                    <div class="mb-3 row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                        <div class="col-md-6">
                            <input id="email" type="email"
                                class="form-control <?= (isset($this->error['email'])) ? 'is-invalid' : null ?>"
                                name="email" value="<?= htmlspecialchars($this->usuario->email) ?>" required
                                autocomplete="email" disabled>
                            <!-- control de errores -->
                            <span class="form-text text-danger" role="alert">
                                <?= $this->error['email'] ?? '' ?>
                            </span>
                        </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="card-footer">
                        <a class="btn btn-secondary" href="<?= URL ?>usuario" role="button"
                            onclick="return confirm('¿Estás seguro de que deseas cancelar? Se perderán los datos ingresados.')">Cancelar</a>
                        <button type="reset" class="btn btn-danger" disabled>Borrar</button>
                        <button type="submit" class="btn btn-primary" disabled>Enviar</button>
                    </div>


                </form>
                <!-- Fin formulario nuevo usuario -->
            </div>
        </div>
        <br><br><br>

    </div>

    <!-- /.container -->

    <?php require_once 'template/partials/footer.partial.php' ?>
    <?php require_once 'template/layouts/javascript.layout.php' ?>

</body>

</html>