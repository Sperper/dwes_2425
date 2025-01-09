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
                <!-- Enviar al controlador update con el id del alumno -->
                <form action="<?= URL ?>alumno/update/<?= $this->id ?>" method="POST">

                    <!-- id oculto -->
                    <!-- Tengo que pasar el id oculto para que el controlador pueda validar doblemente el id -->
                    <input type="number" class="form-control" name="id" value="<?= $this->alumno->id ?>" hidden>

                    <!-- Nombre -->
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" value="<?= $this->alumno->nombre ?>">
                    </div>
                    <!-- Apellidos -->
                    <div class="mb-3">
                        <label for="apellidos" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" name="apellidos" value="<?= $this->alumno->apellidos ?>">
                    </div>
                    <!-- Fecha Nacimiento -->
                    <div class="mb-3">
                        <label for="fechaNac" class="form-label">Fecha Nacimiento</label>
                        <input type="date" class="form-control" name="fechaNac" value="<?= $this->alumno->fechaNac ?>">
                    </div>
                    <!-- Dni -->
                    <div class="mb-3">
                        <label for="dni" class="form-label">Dni</label>
                        <input type="text" class="form-control" name="dni" value="<?= $this->alumno->dni ?>">
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="<?= $this->alumno->email ?>">
                    </div>
                    <!-- Telefono -->
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" name="telefono" value="<?= $this->alumno->telefono ?>">
                    </div>
                    <!-- Nacionalidad -->
                    <div class="mb-3">
                        <label for="nacionalidad" class="form-label">Nacionalidad</label>
                        <input type="text" class="form-control" name="nacionalidad" value="<?= $this->alumno->nacionalidad ?>">
                    </div>

                    <!-- Select Dinámico Cursos -->
                    <div class="mb-3">
                        <label for="curso" class="form-label">Curso</label>
                        <select class="form-select" name="id_curso">
                            <option selected disabled>Seleccione curso</option>
                            <!-- mostrar lista cucrsos -->
                            <?php foreach ($this->cursos as $indice => $data): ?>
                                <option value="<?= $indice ?>" 
                                    <?php if ($indice == $this->alumno->id_curso) echo 'selected' ?>>
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
                <button type="submit" class="btn btn-primary">Actualizar</button>
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