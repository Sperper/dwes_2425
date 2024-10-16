<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Proyecto Ejemplo - Tabla de alumnos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- icon bootstrap 1.11.1-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

</head>

<body>

    <div class="container">

        <!-- Cabecera  -->
        <header class="pb-3 mb-4 border-bottom">
            <i class="bi bi-person"></i>
            <span class="fs-4">Proyecto - Tabla de alumnos</span>
        </header>

        <legend>Tabla alumnos</legend>

        <!-- Furmulario nuevo alumnos -->
        <form action="new.php" method="POST">

            <!-- id -->
            <div class="mb-3 row">
                <label for="inputid" class="col-sm-2 col-form-label">Id</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputid" name="id">
                </div>
            </div>


            <!-- Nombre -->
            <div class="mb-3 row">
                <label for="inputnombre" class="col-sm-2 col-form-label">Nombre</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputnombre" name="nombre">
                </div>
            </div>

            <!-- Poblacion -->
            <div class="mb-3 row">
                <label for="inputPoblacion" class="col-sm-2 col-form-label">Poblacion</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPoblacion" name="poblacion">
                </div>
            </div>

            <!-- Curso -->
            <div class="mb-3 row">
                <label for="inputcurso" class="col-sm-2 col-form-label">Curso</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputcurso" name="curso">
                </div>
            </div>

            <!-- Botones de accion -->

            <a class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
            <button class="btn btn-danger" type="reset">Borrar</button>
            <button class="btn btn-primary" type="submit" formaction="create.php">Crear</button>

        </form>


        <!-- pie del documento -->
        <footer class="footer mt-auto py-3 fixed-bottom bg-light">
            <div class="container">
                <span class="text-muted">
                    &copy Samuel Pérez Pérez - DWES - 2º DAW - Curso 24/25
                </span>
            </div>
        </footer>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>