<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Examen Tema 02 - Movimiento Circular</title>

    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Bootstrap Icons 1.11.1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">

        <header class="pb-3 mb-4 border-bottom">
            <i class="bi bi-calendar-week-fill"></i>
            <span class="fs-3">Examen Práctico</span>
        </header>

        <legend>Movimiento Circular</legend>

        <form method="POST">

            <label for="inputPassword5" class="form-label">Radio de la frecuencia</label>
            <input type="number" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock"
                step="0.01" name="radio" placeholder="0.00">
            <div id="passwordHelpBlock" class="form-text">
                (m)
            </div>
            <label for="inputPassword5" class="form-label">Frecuencia de la rotación</label>
            <input type="number" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock"
                step="0.01" name="frecuencia" placeholder="0.00">
            <div id="passwordHelpBlock" class="form-text">
                (Hz)
            </div>
            <label for="inputPassword5" class="form-label">Masa del objeto</label>
            <input type="number" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock"
                step="0.01" name="masa" placeholder="0.00">
            <div id="passwordHelpBlock" class="form-text">
                (Kg)
            </div>

            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="reset" class="btn btn-secondary">Borrar</button>
                <button type="submit" class="btn btn-warning" formaction="calcular.php">Calcular</button>
            </div>

        </form>

    </div>


    <!-- Pie del documento -->
    <footer class="footer mt-auto py-3 fixed-bottom bg-light">
        <div class="container">
            <span class="text-muted">©
                Samuel Pérez Pérez - DWES - 2º DAW - Curso 24/25</span>
        </div>
    </footer>

    <!-- Bootstrap Javascript y popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>