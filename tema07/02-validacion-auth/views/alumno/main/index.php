<!doctype html>
<html lang="es">

<head>
    <?php require_once 'template/layouts/head.layout.php'; ?>
    <title>Alumnos - Gestión FP </title>
</head>

<body>
    <!-- Menú fijo superior -->
    <?php require_once 'template/partials/menu.partial.php' ?>

    <!-- Capa Principal -->
    <div class="container">
        <br><br><br><br>

         <!-- capa de errores -->
         <?php require_once 'template/partials/error.partial.php' ?>

        <!-- capa de mensajes -->
        <?php require_once 'template/partials/mensaje.partial.php' ?>

        <!-- Estilo card de bootstrap -->
        <div class="card">
            <div class="card-header">
            <h5 class="card-title"><?= $this->title ?></h5>
            </div>
            <div class="card-body">
                <!-- detalles de alumnos  -->

                <!-- Menú principal panel de alumnos  -->
                <?php include 'views/alumno/partials/menu.alumno.partial.php'; ?>

                <!-- tabla de alumnos -->
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <!-- Mostramos el encabezado de la tabla -->
                            <tr>
                                <th>Id</th>
                                <th>Alumno</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Nacionalidad</th>
                                <th>DNI</th>
                                <th>Curso</th>
                                <th class='text-end'>Edad</th>
                                <!-- columna de acciones -->
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Mostramos cuerpo de la tabla -->
                            <?php while ($alumno = $this->alumnos->fetch()): ?>
                                <tr class="align-middle">
                                    <!-- Detalles de artículos -->
                                    <td><?= $alumno->id ?></td>
                                    <td><?= $alumno->alumno ?></td>
                                    <td><?= $alumno->email ?></td>
                                    <td><?= $alumno->telefono ?></td>
                                    <td><?= $alumno->nacionalidad ?></td>
                                    <td><?= $alumno->dni ?></td>
                                    <td><?= $alumno->curso ?></td>
                                    <td class='text-end'><?= $alumno->edad ?></td>

                                    <!-- Columna de acciones -->
                                    <td>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <a href="<?= URL ?>alumno/eliminar/<?= $alumno->id ?>/<?= $_SESSION['csrf_token'] ?>" title="Eliminar"
                                                class="btn btn-danger"
                                                onclick="return confirm('Confimar elimación del alumno')" aria-label="Eliminar alumno"><i
                                                    class="bi bi-trash-fill"></i></a>
                                            <a href="<?= URL ?>alumno/editar/<?= $alumno->id ?>/<?= $_SESSION['csrf_token'] ?>" title="Editar"
                                                class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                            <a href="<?= URL ?>alumno/mostrar/<?= $alumno->id ?>/<?= $_SESSION['csrf_token'] ?>" title="Mostrar"
                                                class="btn btn-warning"><i class="bi bi-eye-fill"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                        
                    </table>
                    
                </div>
            </div>
            <div class="card-footer">
            Nº Alumnos <?= $this->alumnos->rowCount() ?>
            </div>
        </div>
        <br><br><br>

    </div>

    <!-- /.container -->

    <?php require_once 'template/partials/footer.partial.php' ?>
    <?php require_once 'template/layouts/javascript.layout.php' ?>

</body>

</html>