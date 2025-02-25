<!doctype html>
<html lang="es">

<head>
    <?php require_once 'template/layouts/head.layout.php'; ?>
    <title>Contactar </title>
</head>

<body>
    <!-- Menú fijo superior -->
    <?php require_once 'template/partials/menu.partial.php' ?>

    <!-- Capa Principal -->
    <div class="container">
        <br><br><br><br><br>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <?php require_once("template/partials/mensaje.partial.php") ?>
                <?php require_once("template/partials/error.partial.php") ?>
            </div>
            <div class="col-md-8">
                <a class="btn btn-secondary" href="<?= URL ?>index" role="button">Volver</a>
            </div>
        </div>
    </div>

    <!-- /.container -->

    <?php require_once 'template/partials/footer.partial.php' ?>
    <?php require_once 'template/layouts/javascript.layout.php' ?>

</body>

</html>