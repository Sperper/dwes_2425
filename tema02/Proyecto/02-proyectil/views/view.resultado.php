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

        <!-- Cabecera  -->
        <header class="pb-3 mb-4 border-bottom">
            <i class="bi bi-rocket-takeoff-fill"></i>
            <span class="fs-4">Proyecto 2.2 - Lanzamiento proyectiles</span>
        </header>
        <legend>Lanzamiento proyectiles</legend>

        <table class="table">

            <thead>
                <tr>
                    <th scope="row">Valores iniciales</th>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Velocidad inicial:</td>
                    <td><?= $velocidadInicial ?></td>
                </tr>
                <tr>
                    <td>Ángulo Inclinación:</td>
                    <td><?= $anguloInclinacion ?></td>
                </tr>
                <tr>
                    <th scope="row">Resultados</th>
                    <td></td>
                </tr>
                <tr>
                    <td>Ángulo Radianes:</td>
                    <td><?= $radianes ?></td>
                </tr>
                <tr>
                    <td>Velocidad Inicial X:</td>
                    <td><?= $velocidadInicialX ?></td>
                </tr>
                <tr>
                    <td>Velocidad Inicial Y:</td>
                    <td><?= $velocidadInicialY ?></td>
                </tr>
                <tr>
                    <td>Alcance Máximo del Proyectil:</td>
                    <td><?= $alcanceMax ?></td>
                </tr>
                <tr>
                    <td>Tiempo de Vuelo del Proyectil:</td>
                    <td><?= $tiempo ?></td>
                </tr>
                <tr>
                    <td>Altura Máxima de Proyectil:</td>
                    <td><?= $alturaMax ?></td>
                </tr>

            </tbody>


        </table>


        <div class="btn-group" role="group">
            <a class="btn btn-secondary" href="index.php" role="button">Volver</a>
        </div>


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