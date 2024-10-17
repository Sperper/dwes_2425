<!doctype html>
<html lang="es">

<head>
    <!-- Frameworks bootstrap -->
    <?php include 'layouts/head.html'; ?>

    <title>Proyecto 31 - CRUD Alumnos Array</title>

<body>
    <!-- capa principal -->
    <div class="container">

        <?php include 'partes//header.php'?>

        <!-- Mostrar la tabla de alumnos -->
        <legend>Tabla de Alumnos</legend>

        <!-- Menú alumnos  -->
        <?php include 'partes/menuAlumno.php'; ?>

        <div class="table-responsive">
            <table class="table table-striped table-hover border">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Población</th>
                        <th scope="col">Curso</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alumnos as $registro): ?>
                        <tr class="">
                            <td><?= $registro['id'] ?></td>
                            <td><?= $registro['nombre'] ?></td>
                            <td><?= $registro['poblacion'] ?></td>
                            <td><?= $registro['curso'] ?></td>

                            <!-- Botones de Acción -->
                            <td>
                                <a href="delete.php?id=<?= $registro['id'] ?>" title="Eliminar"
                                    onclick="return confirm('Confimar elimación del alumno')">
                                    <i class="bi bi-trash-fill"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4">Total Alumnos: <?= count($alumnos) ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>


        <!-- Pie del documento -->
        <footer class="footer mt-auto py-3 fixed-bottom bg-light">
            <div class="container">
                <span class="text-muted">© 2024
                    Juan Carlos Moreno - DWES - 2º DAW - Curso 24/25</span>
            </div>
        </footer>

    </div>

    <?php include 'layouts/javascript.html'; ?>
</body>

</html>