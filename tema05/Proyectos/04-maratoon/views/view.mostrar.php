<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/layout.head.html'; ?>
    <title>Mostrar Corredor - BBDD maratoon </title>

    <style>
        #cajaSexo {
            border: gainsboro 2px solid;
            padding: 10px;
        }
    </style>
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <?php include 'views/partials/partial.header.php'; ?>

        <legend>Formulario Mostrar Corredor</legend>

        <!-- Formulario Mostrar corredor -->

        <form action="create.php" method="POST">

            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?= $corredor->nombre ?>" readonly>
            </div>

            <!-- Apellidos -->
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos" value="<?= $corredor->apellidos ?>" readonly>
            </div>

            <!-- Apellidos -->
            <div class="mb-3">
                <label for="ciudad" class="form-label">Ciudad</label>
                <input type="text" class="form-control" name="ciudad" value="<?= $corredor->ciudad ?>" readonly>
            </div>

            <!-- Fecha Nacimiento -->
            <div class="mb-3">
                <label for="fechaNacimiento" class="form-label">Fecha de Nacimiento</label>
                <input type="date" class="form-control" name="fechaNacimiento" value="<?= $corredor->fechaNacimiento ?>"
                    readonly>
            </div>

            <!-- Sexo -->
            <div class="mb-3">
                <label for="fechaNacimiento" class="form-label">Sexo</label>
                <input type="text" class="form-control" name="fechaNacimiento" value="<?= $corredor->sexo ?>" readonly>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="<?= $corredor->email ?>" readonly>
            </div>

            <!-- Dni -->
            <div class="mb-3">
                <label for="dni" class="form-label">Dni</label>
                <input type="text" class="form-control" name="dni" value="<?= $corredor->dni ?>" readonly>
            </div>

            <!-- Categoría -->
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoría</label>
                <input type="text" class="form-control" name="categoria" value="<?= $categoria_corredor ?>" readonly>
            </div>

            <!-- Clubs -->
            <div class="mb-3">
                <label for="club" class="form-label">Clubs</label>
                <input type="text" class="form-control" name="club" value="<?= $club_corredor ?>" readonly>
            </div>


            <!-- Select Dinámico Categorías -->
            <div class="mb-3">
                <label for="club" class="form-label">Categoría</label>
                <select class="form-select" name="id_categoria">
                    <option selected disabled>Seleccione categoría</option>
                    <!-- mostrar lista cucrsos -->
                    <?php foreach ($categorias as $data): ?>
                        <option value="<?= $data['id'] ?>">
                            <?= $data['categoria'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Select Dinámico Clubs -->
            <div class="mb-3">
                <label for="club" class="form-label">Club</label>
                <select class="form-select" name="id_club">
                    <option selected disabled>Seleccione club</option>
                    <!-- mostrar lista cucrsos -->
                    <?php foreach ($clubs as $data): ?>
                        <option value="<?= $data['id'] ?>">
                            <?= $data['club'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- botones de acción -->
            <a class="btn btn-secondary" href="index.php" role="button">Cancelar</a>

        </form>
        <!-- Fin formulario Mostrar corredor -->
    </div>
    <br><br><br>

    <!-- Pie del documento -->
    <?php include 'views/partials/partial.footer.php'; ?>

    <!-- Bootstrap Javascript y popper -->
    <?php include 'views/layouts/layout.javascript.html'; ?>


</body>

</html>