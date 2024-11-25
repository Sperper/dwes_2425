<!DOCTYPE html>
<html lang="es">

<head>
    <!-- inclye head -->
    <?php include "layouts/layout.head.html" ?>
    <title>Nuevo Jugador - CRUD Jugadores </title>
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <!-- incluye header -->

        <legend>Formulario Nuevo Jugador</legend>

        <!-- Formulario Nuevo libro -->

        <form method="POST" action="create.php">

            <!-- id -->
            <div class="mb-3">
                <label for="id" class="form-label">Id</label>
                <input type="text" class="form-control" name="id">
            </div>

            <!-- nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre">
            </div>

            <!-- f_nacimiento -->
            <div class="mb-3">
                <label for="fecha_edicion" class="form-label">Fecha Nacimiento</label>
                <input type="date" class="form-control" name="fecha_nacimiento">
            </div>

            <!-- nacionalidad -->
            <div class="mb-3">
                <label for="nacionalidad" class="form-label">Nacionalidad</label>
                <input type="text" class="form-control" name="nacionalidad">
            </div>

            <!-- Nº Camiseta -->
            <div class="mb-3">
                <label for="num_camiseta" class="form-label">num_camiseta</label>
                <input type="number" class="form-control" name="num_camiseta">
            </div>

            <!-- altura -->
            <div class="mb-3">
                <label for="altura" class="form-label">Altura (m)</label>
                <input type="number" class="form-control" step="0.01" name="altura">
            </div>

            <!-- peso -->
            <div class="mb-3">
                <label for="peso" class="form-label">Peso (Kg)</label>
                <input type="number" class="form-control" step="0.01" name="peso">
            </div>

            <!-- valor mercado -->
            <div class="mb-3">
                <label for="valor_mercado" class="form-label">Valor Mercado (€)</label>
                <input type="number" class="form-control" step="0.01" name="valor_mercado">
            </div>

            <!-- Select Dinámico Equipo -->
            <div class="mb-3">
                <label for="equipo_id" class="form-label">Equipo</label>
                <select class="form-select" name="equipo" id="equipo">
                    <option selected disabled>Seleccione equipo</option>
                    <!-- mostrar lista equipos -->
                    <?php foreach ($equipos as $indice => $equipo): ?>
                        <option value="<?= $indice ?>" name="equipo">
                            <?= $equipo ?>
                        </option>
                    <?php endforeach; ?>
                </select>

            </div>

            <!-- lista checbox dinámica posiciones_id -->
            <div class="mb-3">
                <label for="posiciones_id" class="form-label">Posiciones de juego</label>
                <div class="form-control">
                    <!-- muestro el array posiciones -->
                    <?php foreach ($posiciones as $indice => $posicion): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="posiciones[]" value="<?= $indice ?>">
                            <label class="form-check-label" for="flexCheckDefault">
                                <?= $posicion ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- botones de acción -->
            <a class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Borrar</button>
            <button type="submit" class="btn btn-primary">Enviar</button>

        </form>

        <!-- Fin formulario nuevo jugador -->



    </div>
    <br><br><br>

    <!-- Pie del documento -->
    <!-- incluye footer -->
    <?php include "partials/partial.footer.php" ?>

    <!-- Bootstrap Javascript y popper -->
    <!-- inclye javascript -->
    <?php include "layouts/layout.javascript.html" ?>


</body>

</html>