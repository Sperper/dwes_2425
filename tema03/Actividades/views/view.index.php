<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ejemplo 14 - vista</title>

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
            <i class="bi bi-app-indicator"></i>
            <span class="fs-3">Ejemplo 14 - Tabla alumnos</span>
        </header>

        <h1>Ejemplo 05</h1>

    </div>

    <!-- Mostrar la tabla de alumnos -->
    <table class="table">
        <thead>
            <tr>
                <th scope="row">Valores Iniciales</th>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Radio de la frecuencia</td>
                <td><?= number_format($radio, 2, ",", "."); ?> m</td>
            </tr>
            <tr>
                <td>Frecuencia de rotación</td>
                <td><?= number_format($frecuenciaRotacion, 2, ",", "."); ?> Hz</td>
            </tr>
            <tr>
                <td>Masa del objeto</td>
                <td><?= number_format($masaObjeto, 2, ",", "."); ?> Kg</td>
            </tr>
            <tr>
                <th scope="row">Calculos</th>
                <td></td>
            </tr>
            <tr>
                <td>Velocidad tangencial</td>
                <td><?= number_format($velocidadTangencial, 2, ",", "."); ?> m/s</td>
            </tr>

            <tr>
                <td>Aceleración centrípeta</td>
                <td><?= number_format($aceleracionCentripeta, 2, ",", "."); ?> m/s2</td>
            </tr>
            <tr>
                <td>Fuerza centrípeta</td>
                <td><?= number_format($fuerzaCentripeta, 2, ",", "."); ?> N</td>
            </tr>
            <tr>
                <td>Periodo</td>
                <td><?= number_format($periodo, 10, ",", "."); ?> s</td>
            </tr>
        </tbody>

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