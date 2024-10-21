<!doctype html>
<html lang="es">

<head>
    <!-- Frameworks bootstrap -->
    <?php include 'views/layouts/head.html'; ?>

    <title>Proyecto 31 - CRUD Alumnos Array</title>
</head>

<body>
    <!-- capa principal -->
    <div class="container">

        <!-- cabecera documento -->
        <?php include 'views/partials/header.php' ?>

        <!-- Mostrar la tabla de alumnos -->
        <legend>Tabla de Alumnos</legend>

        <!-- Menú alumnos  -->
        <?php include 'views/partials/m_alumnos.php' ?>

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
                                <!-- botón eliminar -->
                                <a href="delete.php?id=<?= $registro['id'] ?>" title="Eliminar"
                                onclick="return confirm('Confimar elimación del alumno')">
                                <i class="bi bi-trash-fill"></i></a>

                                <!-- botón editar -->
                                <a href="edit.php?id=<?= $registro['id'] ?>" title="Editar">
                                <i class="bi bi-pencil-square"></i></a>

                                <!-- botón  mostrar -->
                                <a href="show.php?id=<?= $registro['id'] ?>" title="Mostrar">
                                <i class="bi bi-card-text"></i></a> 
                                
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
        <?php include 'views/partials/footer.php'; ?>

    </div>
    <!-- javascript bootstrap 533 -->
    <?php include 'views/layouts/javascript.html'; ?>
</body>

</html>