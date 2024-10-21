<!doctype html>
<html lang="es">

<head>
    <!-- Frameworks bootstrap -->
    <?php include 'views/layouts/head.html'; ?>

    <title>Proyecto 31 - CRUD Alumnos Array</title>
</head>

<body>
    <!-- capa principal -->
    <div class="container">

        <!-- cabecera documento -->
        <?php include 'views/partials/header.php' ?>

        <!-- Mostrar la tabla de alumnos -->
        <legend>Formulario Nuevo Alumno</legend>

        <!-- Formulario Nuevo alumno -->
        <form action="create.php" method="POST">

            <!-- id -->
            <div class="mb-3 row">
                <label for="inputid" class="col-sm-2 col-form-label">Id:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputid" name="id">
                </div>
            </div>
            <!-- nombre -->
            <div class="mb-3 row">
                <label for="inputnombre" class="col-sm-2 col-form-label">Nombre:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputnombre" name="nombre">
                </div>
            </div>
            <!-- poblacion  -->
            <div class="mb-3 row">
                <label for="inputpoblacion" class="col-sm-2 col-form-label">Población:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputpoblacion" name="poblacion">
                </div>
            </div>
            <!-- curso  -->
            <div class="mb-3 row">
                <label for="inputcurso" class="col-sm-2 col-form-label">Curso:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputcurso" name="curso">
                </div>
            </div>

            <!-- botones de acción -->
            <a class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Borrar</button>
            <button type="submit" class="btn btn-primary">Enviar</button>
 
        </form>
        <!-- fin formulario -->


        <!-- Pie del documento -->
        <?php include 'views/partials/footer.php'; ?>

    </div>
    <!-- javascript bootstrap 533 -->
    <?php include 'views/layouts/javascript.html'; ?>
</body>

</html>