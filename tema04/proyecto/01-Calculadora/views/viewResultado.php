<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>2.1 Calcyladora básica</title>

    <!-- css bootstrap 5.3.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Bootstrap icons 1.11.3 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>
    <!-- cabecera proyectoo -->
    <header class="pb-3 mb-4 border-bottom">
        <i class="bi bi-calculator"></i>
        <span class="fs-4">Proyecto 2.1 - Calculadora Básica</span>
    </header>

    <!-- Formulario -->
    <legend>Calculadora Básica</legend>

    <!-- Fin de formulario -->
    <form>
        <!-- Valor 1 -->
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Valor 1</span>
            <input type="number" class="form-control" aria-label="Sizing example input"
                aria-describedby="inputGroup-sizing-default" step="0.01" value="<?= $valor1 ?>" readonly>
        </div>

        <!-- Valor 2 -->
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default" name="valor2">Valor 2</span>
            <input type="number" class="form-control" aria-label="Sizing example input"
                aria-describedby="inputGroup-sizing-default" step="0.01" value="<?= $valor2 ?>" readonly>
        </div>

        <!-- Resultado -->
        <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg">Resultado</span>
            <input type="number" class="form-control" aria-label="Sizing example input"
                aria-describedby="inputGroup-sizing-lg" value="<?= $resultado ?>" readonly>
        </div>

        <div class="btn-group" role="group">
            <button type="submit" class="btn btn-secondary" formaction="index.php">Volver</button>
        </div>

    </form>
    <footer class="footer mt-auto py-3 fixed-bottom bg-light">
        <div class="container">
            <span class="text-muted">2024 Samuel Pérez Pérez - DWES - 2ºDAW - Curso 24/25</span>
        </div>
    </footer>
</body>

</html>