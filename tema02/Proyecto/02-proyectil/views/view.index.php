<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Proyecto 2.2 - Lanzamiento de proyectiles</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- icon bootstrap 1.11.1-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

</head>

<body>
    <div class="container">
        <header class="pb-3 mb-4 border-bottom">
            <i class="bi bi-rocket-takeoff-fill"></i>
            <span class="fs-4">Proyecto 2.2 - Lanzamiento proyectiles</span>
        </header>
        <legend>Lanzamiento proyectiles</legend>

        <form method="POST">


            <!-- Primer formulario -->
            <label for="inputPassword5" class="form-label">Velocidad inicial</label>
            <input type="number" class="form-control" name="VelocidadInicial" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            <div id="passwordHelpBlock" class="form-text">
                Velocidad en m/s
            </div>

            <br>

            <!-- Segundo formulario  -->
            <label for="inputPassword" class="form-label">Angulo de lazamiento</label>
            <input type="number" class="form-control" name="AnguloDeLanzamiento" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            <div id="passwordHelpBlock" class="form-text">
                Ángulo en grados
            </div>

            <br>

            <!-- Botones -->
            <div class="btn-group" role="group">
                <button type="reset" class="btn btn-secondary">Borrar</button>
                <button type="submit" class="btn btn-warning" formaction="calcular.php">Calcular</button>
            </div>


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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>