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
                <form action="<?= URL ?>usuario/create" method="POST">

                    <!-- protección CSRF -->
                    <input type="hidden" name="csrf_token"
                        value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">

                    <!-- campo name -->
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                        <div class="col-md-6">
                            <input id="name" type="name"
                                class="form-control <?= (isset($this->errores['name'])) ? 'is-invalid' : null ?>"
                                name="name" value="<?= htmlspecialchars($this->name); ?>" required
                                autocomplete="name" autofocus>
                            <!-- control de errores -->
                            <span class="form-text text-danger" role="alert">
                                <?= $this->error['name']  ??= '' ?>
                            </span>
                        </div>
                    </div>

                    <!-- campo email -->
                    <div class="mb-3 row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                        <div class="col-md-6">
                            <input id="email" type="email"
                                class="form-control <?= (isset($this->errores['email'])) ? 'is-invalid' : null ?>"
                                name="email" value="<?= htmlspecialchars($this->email); ?>" required
                                autocomplete="email" autofocus>
                            <!-- control de errores -->
                            <span class="form-text text-danger" role="alert">
                                <?= $this->error['email']  ??= '' ?>
                            </span>
                        </div>
                    </div>

                    <!-- password -->
                    <div class="mb-3 row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                        <div class="col-md-6">
                            <input id="password" type="password"
                                class="form-control <?= (isset($this->errores['password'])) ? 'is-invalid' : null ?>"
                                name="password" value="<?= htmlspecialchars($this->password)  ?>" required
                                autocomplete="current-password">

                            <!-- control de errores -->
                            <span class="form-text text-danger" role="alert">
                                <?= $this->error['password']  ??= null ?>
                            </span>
                        </div>
                    </div>

                    <!-- password confirmación -->
                    <div class="mb-3 row">
                        <label for="password_confirm" class="col-md-4 col-form-label text-md-right">Confirmar Password</label>

                        <div class="col-md-6">
                            <input id="password_confirm" type="password"
                                class="form-control"
                                name="password_confirm" required
                                autocomplete="password_confirm">
                        </div>
                    </div>

            </div>
            <div class="card-footer">
                <!-- botones de acción -->
                <a class="btn btn-secondary" href="<?= URL ?>usuario" role="button">Cancelar</a>
                <button type="reset" class="btn btn-danger">Borrar</button>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
            </form>
            <!-- Fin formulario nuevo usuario -->
        </div>
        <br><br><br>

    </div>

    <!-- /.container -->

    <?php require_once 'template/partials/footer.partial.php' ?>
    <?php require_once 'template/layouts/javascript.layout.php' ?>

</body>

</html>