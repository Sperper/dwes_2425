<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Actividad 3.2 - Tabla de multiplicar</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- icon bootstrap 1.11.1-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

</head>

<body>

    <div class="container">

        <!-- Cabecera  -->
        <header class="pb-3 mb-4 border-bottom">
            <i class="bi bi-book"></i>
            <span class="fs-4">Actividad 3.2 - Tabla de multiplicar</span>
        </header>

        <legend>Tabla de multiplicar</legend>

        <table class="table">

            <thead>
                <th>
                    
                </th>
                <?php for ($i = 0; $i <= 10; $i++) {?>
                <th>
                    <?= $i ?>
                </th>
                <?php } ?>
            </thead>
            <tbody>
                <?php for ($i = 0; $i <= 10; $i++) {

                }?>
            </tbody>


        </table>

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