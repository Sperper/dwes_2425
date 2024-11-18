<!DOCTYPE html>
<html lang="es">
<head>
    <?php include 'views/layouts/layout.head.html'; ?>
    <title>Gestión de Profesores - Home </title>
</head>
<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <?php include 'views/partials/partial.header.php'; ?>

                
        <!-- Menú principal -->
        <?php include 'views/partials/partial.menu.php';?>
       
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <!-- Mostramos el encabezado de la tabla -->
                    <tr class="align-middle">
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Nrp</th>
                        <th>Fecha_nacimiento</th>
                        <th>Población</th>
                        <th>Especialidad</th>
                        <th>Asignaturas</th>
                        <!-- columna de acciones -->
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Mostramos cuerpo de la tabla -->
                    <?php foreach ($array_profesores as $indice => $profesor): ?>
                        <tr class="align-middle">
                            <!-- Detalles de artículos -->
                            <td><?= $profesor->id ?></td>
                            <td><?= $profesor->nombre?></td>
                            <td><?= $profesor->apellidos ?></td>
                            <td><?= $profesor->nrp ?></td>
                            <td><?= $profesor->fecha_nacimiento ?></td>
                            <td><?= $profesor->poblacion ?></td>
                            <td><?= $especialidades[$profesor->especialidad] ?></td>
                            <td><?= implode(', ', $obj_tabla_profesores->mostrar_nombre_asignaturas($profesor->asignaturas)) ?></td>
                            
                            <!-- Columna de acciones -->
                            <td>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <a href="delete.php?indice=<?=$indice ?>" title="Eliminar" class="btn btn-danger" onclick="return confirm('Confimar elimación del libro')"><i class="bi bi-trash-fill"></i></a>
                                <a href="editar.php?indice=<?=$indice ?>" title="Editar" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                <a href="mostrar.php?indice=<?=$indice ?>" title="Mostrar" class="btn btn-warning"><i class="bi bi-eye-fill"></i></a>
                            </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>   
                </tbody>
                <tfoot>
                    <tr><td colspan="6">Nº Registros <?= count($array_profesores) ?></td></tr>
                </tfoot>
            </table>
        </div>
    </div>
    <br><br><br>

    <!-- Pie del documento -->
    <?php include 'views/partials/partial.footer.php';?>

    <!-- Bootstrap Javascript y popper -->
    <?php include 'views/layouts/layout.javascript.html';?>
    
 
</body>
</html>