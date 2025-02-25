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
                <h5 class="card-title"><?= $this->title ?></h5>
            </div>
            <div class="card-body">
                <!-- Formulario de alumnos  sin edicion-->
                <form>

                    <!-- id -->
                    <div class="mb-3">
                        <label for="id" class="form-label">Id</label>
                        <input type="number" class="form-control" value="<?= $this->alumno->id ?>" disabled>
                    </div>

                    <!-- Nombre -->
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" value="<?= $this->alumno->nombre ?>" disabled>
                    </div>
                    <!-- Apellidos -->
                    <div class="mb-3">
                        <label for="apellidos" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" value="<?= $this->alumno->apellidos ?>" disabled>
                    </div>
                    <!-- Fecha Nacimiento -->
                    <div class="mb-3">
                        <label for="fechaNac" class="form-label">Fecha Nacimiento</label>
                        <input type="date" class="form-control" value="<?= $this->alumno->fechaNac ?>" disabled>
                    </div>
                    <!-- Dni -->
                    <div class="mb-3">
                        <label for="dni" class="form-label">Dni</label>
                        <input type="text" class="form-control" value="<?= $this->alumno->dni ?>" disabled>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" value="<?= $this->alumno->email ?>" disabled>
                    </div>
                    <!-- Telefono -->
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" value="<?= $this->alumno->telefono ?>" disabled>
                    </div>
                    <!-- Nacionalidad -->
                    <div class="mb-3">
                        <label for="nacionalidad" class="form-label">Nacionalidad</label>
                        <input type="text" class="form-control" value="<?= $this->alumno->nacionalidad ?>" disabled>
                    </div>

                    <!-- Curso -->
                    <div class="mb-3">
                        <label for="curso" class="form-label">Curso</label>
                        <input type="text" class="form-control" value="<?= $this->cursos[$this->alumno->id_curso] ?>" disabled>
                    </div>

            </div>
            <div class="card-footer">
                <!-- botones de acción -->
                <a class="btn btn-secondary" href="<?= URL ?>alumno" role="button">Volver</a>
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