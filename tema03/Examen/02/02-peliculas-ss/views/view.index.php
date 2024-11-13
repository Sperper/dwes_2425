<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Cargar bootstrap css -->
    <?php include "layouts/head.html" ?>
    <title>Gestión de Películas - Home </title>
</head>
<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <?php include "partials/partial.header.php" ?>
        <!-- Menú principal -->
        <?php include "partials/partial.menu.php"; ?>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <!-- encabezado de la tabla -->
                   <th>Id</th>
                   <th>Titulo</th>
                   <th>Pais</th>
                   <th>Director</th>
                   <th>Genero</th>
                   <th>Año</th>
                   <th>Acciones</th>
                </thead>
                <tbody>
                    <?php foreach($peliculas as $indice => $pelicula): ?>
                        <tr class="align-middle">
                            <?php foreach($pelicula as $valor): ?>
                            <!-- Columnas de la tabla películas -->
                            <td>
                                <?= $valor ?>
                            </td>
                            <?php endforeach; ?>
                            <!-- Columna de acciones -->
                            <td>
                                <a href="eliminar.php?indice=<?= $indice ?>" title="Eliminar" class="btn btn-secondary"><i class="bi bi-trash-fill"></i></a>
                                <a href="editar.php?indice=<?= $indice ?>" title="Editar" class="btn btn-secondary"><i class="bi bi-pencil-square"></i></a>
                                <a href="mostrar.php?indice=<?= $indice ?>" title="Mostrar" class="btn btn-secondary"><i class="bi bi-eye-fill"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <!-- Mostrar el número de registros -->
                    <tr><td colspan="6">Nº Registros: <?= count($peliculas) ?></td></tr>
                </tfoot>
            </table>
        </div>
    </div>
    <br><br><br>

    <!-- Pie del documento -->
    <?php include "partials/partial.footer.php" ?>
    <!-- Bootstrap Javascript y popper -->
    <?php include "layouts/javascript.html" ?>
    
 
</body>
</html>