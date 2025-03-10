<!doctype html>
<html lang="es">

<head>
    <?php require_once 'template/layouts/head.layout.php'; ?>
    <title>Usuarios - Gestión FP </title>
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
                <h5 class="card-title"><?= $this->title ?></h5>
            </div>
            <div class="card-body">
                <!-- detalles de usuarios  -->

                <!-- Menú principal panel de usuarios  -->
                <?php include 'views/usuario/partials/menu.usuario.partial.php'; ?>

                <!-- tabla de usuarios -->
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <!-- Mostramos el encabezado de la tabla -->
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Contraseña</th>
                                <!-- columna de acciones -->
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Mostramos cuerpo de la tabla -->
                            <?php while ($usuario = $this->usuarios->fetch()): ?>
                                <tr class="align-middle">
                                    <!-- Detalles de usuarios -->
                                    <td><?= $usuario->id ?></td>
                                    <td><?= $usuario->name ?></td>
                                    <td><?= $usuario->email ?></td>
                                    <td><?= $usuario->password ?></td>

                                    <!-- Columna de acciones -->
                                    <td>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <a href="<?= URL ?>usuario/eliminar/<?= $usuario->id ?>/<?= $_SESSION['csrf_token'] ?>" title="Eliminar"
                                                class="btn btn-danger
                                                <?= !in_array($_SESSION['role_id'], $GLOBALS['usuario']['eliminar']) ? 'disabled' : null ?>"
                                                onclick="return confirm('Confimar eliminación del usuario')"><i
                                                    class="bi bi-trash-fill"></i></a>
                                            <a href="<?= URL ?>usuario/editar/<?= $usuario->id ?>/<?= $_SESSION['csrf_token'] ?>" title="Editar"
                                                class="btn btn-primary
                                                <?= !in_array($_SESSION['role_id'], $GLOBALS['usuario']['editar']) ? 'disabled' : null ?>"><i class="bi bi-pencil-square"></i></a>
                                            <a href="<?= URL ?>usuario/mostrar/<?= $usuario->id ?>/<?= $_SESSION['csrf_token'] ?>" title="Mostrar"
                                                class="btn btn-warning
                                                <?= !in_array($_SESSION['role_id'], $GLOBALS['usuario']['mostrar']) ? 'disabled' : null ?>"><i class="bi bi-eye-fill"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                Nº usuarios <?= $this->usuarios->rowCount() ?>
            </div>
        </div>
        <br><br><br>

    </div>

    <!-- /.container -->

    <?php require_once 'template/partials/footer.partial.php' ?>
    <?php require_once 'template/layouts/javascript.layout.php' ?>

</body>

</html>