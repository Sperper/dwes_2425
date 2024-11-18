<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/layout.head.html'; ?>
    <title>Nuevo Profesor - CRUD Profesores </title>
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <?php include 'views/partials/partial.header.php'; ?>

        <legend>Formulario Nuevo Profesores</legend>

        <!-- Formulario Nuevo libro -->

        <form action="create.php" method="POST">

            <!-- id -->
            <div class="mb-3">
                <label for="id" class="form-label">Id</label>
                <input type="text" class="form-control" name="id">
            </div>

            <!-- titulo -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre">
            </div>

            <!-- Apellidos -->
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos">
            </div>

            <!-- nrp -->
            <div class="mb-3">
                <label for="nrp" class="form-label">Nrp</label>
                <input type="text" class="form-control" name="nrp">
            </div>

            <!-- fecha_nacimiento -->
            <div class="mb-3">
                <label for="fecha_nacimiento" class="form-label">Fecha Nacimiento</label>
                <input type="date" class="form-control" name="fecha_nacimiento">
            </div>

            <!-- Poblacion -->
            <div class="mb-3">
                <label for="poblacion" class="form-label">Poblacion</label>
                <input type="number" class="form-control" name="poblacion" step="0.01">
            </div>

            <!-- Select Dinámico Especialidades -->
            <select class="form-select" aria-label="Default select example">
                <option selected>Selecciona una especialidad</option>
                <?php foreach($especialidades as $indice): ?>
                    <option value="<?= $indice ?>"></option>
                <?php endforeach; ?>
            </select>


            <!-- lista checbox dinámica etiquetas -->



            <!-- botones de acción -->
            <a class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Borrar</button>
            <button type="submit" class="btn btn-primary">Enviar</button>

        </form>

        <!-- Fin formulario nuevo artículo -->



    </div>
    <br><br><br>

    <!-- Pie del documento -->
    <?php include 'views/partials/partial.footer.php'; ?>

    <!-- Bootstrap Javascript y popper -->
    <?php include 'views/layouts/layout.javascript.html'; ?>


</body>

</html>