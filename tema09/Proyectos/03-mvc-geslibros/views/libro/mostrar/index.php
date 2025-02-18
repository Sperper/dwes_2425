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
                <h5 class="card-title"><?= htmlspecialchars($this->title) ?></h5>
            </div>
            <div class="card-body">
                <!-- Formulario de libros  sin edicion-->
                <form>

                    <!-- id -->
                    <div class="mb-3">
                        <label for="id" class="form-label">Id</label>
                        <input type="number" class="form-control" value="<?= htmlspecialchars($this->libro->id) ?>" disabled>
                    </div>

                    <!-- Nombre -->
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Titulo</label>
                        <input type="text" class="form-control" value="<?= htmlspecialchars($this->libro->titulo) ?>" disabled>
                    </div>
                    <!-- Apellidos -->
                    <div class="mb-3">
                        <label for="apellidos" class="form-label">Precio</label>
                        <input type="text" class="form-control" value="<?= htmlspecialchars($this->libro->precio) ?>" disabled>
                    </div>
                    <!-- Fecha Nacimiento -->
                    <div class="mb-3">
                        <label for="fechaNac" class="form-label">Fecha Edicion</label>
                        <input type="date" class="form-control" value="<?= htmlspecialchars($this->libro->fecha_edicion) ?>" disabled>
                    </div>
                    <!-- Dni -->
                    <div class="mb-3">
                        <label for="dni" class="form-label">ISBN</label>
                        <input type="text" class="form-control" value="<?= htmlspecialchars($this->libro->isbn) ?>" disabled>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Autor</label>
                        <input type="email" class="form-control" value="<?= htmlspecialchars($this->autores[$this->libro->autor_id]) ?>" disabled>
                    </div>
                    <!-- Telefono -->
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Editorial</label>
                        <input type="tel" class="form-control" value="<?= htmlspecialchars($this->editoriales[$this->libro->editorial_id]) ?>" disabled>
                    </div>
                    <!-- Nacionalidad -->
                    <div class="mb-3">
                        <label for="nacionalidad" class="form-label">Generos</label>
                        <input type="text" class="form-control" value="<?= htmlspecialchars($this->libro->generos_id) ?>" disabled>
                    </div>

                    

            </div>
            <div class="card-footer">
                <!-- botones de acción -->
                <a class="btn btn-secondary" href="<?= URL ?>libro" role="button">Volver</a>
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