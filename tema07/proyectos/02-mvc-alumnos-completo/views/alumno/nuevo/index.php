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
                <!-- Formulario de alumnos  -->
                <form action="<?= URL ?>alumno/create" method="POST">

                    <!-- Nombre -->
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre">
                    </div>
                    <!-- Apellidos -->
                    <div class="mb-3">
                        <label for="apellidos" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" name="apellidos">
                    </div>
                    <!-- Fecha Nacimiento -->
                    <div class="mb-3">
                        <label for="fechaNac" class="form-label">Fecha Nacimiento</label>
                        <input type="date" class="form-control" name="fechaNac">
                    </div>
                    <!-- Dni -->
                    <div class="mb-3">
                        <label for="dni" class="form-label">Dni</label>
                        <input type="text" class="form-control" name="dni">
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <!-- Telefono -->
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" name="telefono">
                    </div>
                    <!-- Nacionalidad -->
                    <div class="mb-3">
                        <label for="nacionalidad" class="form-label">Nacionalidad</label>
                        <input type="text" class="form-control" name="nacionalidad">
                    </div>

                    <!-- Select Dinámico Cursos -->
                    <div class="mb-3">
                        <label for="curso" class="form-label">Curso</label>
                        <select class="form-select" name="id_curso">
                            <option selected disabled>Seleccione curso</option>
                            <!-- mostrar lista cucrsos -->
                            <?php foreach ($this->cursos as $indice => $data): ?>
                                <option value="<?= $indice ?>">
                                    <?= $data ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
            </div>
            <div class="card-footer">
                <!-- botones de acción -->
                <a class="btn btn-secondary" href="<?= URL ?>alumno" role="button">Cancelar</a>
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