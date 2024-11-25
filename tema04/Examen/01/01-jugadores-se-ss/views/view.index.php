<!DOCTYPE html>
<html lang="es">

<head>
    <!-- incluye head -->
    <?php include 'layouts/layout.head.html' ?>
    <title>Gestión de jugadores - Home </title>
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <!-- incluye header -->
        <?php include "partials/partial.header.php" ?>

        <!-- Menú principal -->
        <!-- incluye menú principal -->
        <?php include "partials/partial.menu.php" ?>


        <div class="table-responsive">
            <table class="table">
                <thead>
                    <!-- Mostramos el encabezado de la tabla -->
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Equipo</th>
                        <th>Nacionalidad</th>
                        <th>Posiciones</th>
                        <th class='text-end'>Edad</th>
                        <th class='text-end'>Altura</th>
                        <th class='text-end'>Peso</th>
                        <th class='text-end'>Valor</th>

                        <!-- columna de acciones -->
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($array_jugadores as $indice => $jugador): ?>
                    <!-- Mostramos cuerpo de la tabla -->
                    <tr>
                        <!-- Mostramos detalles del jugador -->
                        <td><?= $jugador->id ?></td>
                        <td><?= $jugador->nombre ?></td>
                        <td><?= $equipos[$jugador->equipo_id]?></td>
                        <td><?= $jugador->nacionalidad ?></td>
                        <td><?= /*implode(',', $obj_tabla_jugadores->mostrar_nombre_posiciones($jugador->$posiciones_id)) */ implode(',',$jugador->posiciones_id)?></td>
                        <td><?= $jugador->f_nacimiento ?></td>
                        <td><?= $jugador->altura?></td>
                        <td><?= $jugador->peso ?></td>
                        <td><?= number_format($jugador->valor_mercado, 2,',','.')?> €</td>
                        

                        <!-- Columna de acciones -->
                        <td>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <a href="delete.php?indice=<?= $indice ?>" title="Eliminar" class="btn btn-danger"
                                    onclick="return confirm('Confimar elimación del jugador')"><i
                                        class="bi bi-trash-fill"></i></a>
                                <a href="editar.php?indice=<?= $indice ?>" title="Editar" class="btn btn-primary"><i
                                        class="bi bi-pencil-square"></i></a>
                                <a href="mostrar.php=indice=<?= $indice ?>" title="Mostrar" class="btn btn-warning"><i class="bi bi-eye-fill"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6">Nº Registros</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <br><br><br>

    <!-- Pie del documento -->
    <!-- inclye footer -->
    <?php include "partials/partial.footer.php" ?>
    <!-- Bootstrap Javascript y popper -->
    <!-- incluye javascript -->
    <?php include 'layouts/layout.javascript.html' ?>

</body>

</html>