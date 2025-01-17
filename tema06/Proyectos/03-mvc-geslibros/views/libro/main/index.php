<!doctype html>
<html lang="es">

<head>
    <?php require_once 'template/layouts/head.layout.php'; ?>
    <title>libros - Gestión FP </title>
</head>

<body>
    <!-- Menú fijo superior -->
    <?php require_once 'template/partials/menu.partial.php' ?>

    <!-- Capa Principal -->
    <div class="container">
        <br><br><br><br>

        <!-- capa de mensajes -->
        <?php require_once 'template/partials/mensaje.partial.php' ?>

        <!-- Estilo card de bootstrap -->
        <div class="card">
            <div class="card-header">
            <h5 class="card-title"><?= $this->title ?></h5>
            </div>
            <div class="card-body">
                <!-- detalles de libros  -->

                <!-- Menú principal panel de libros  -->
                <?php include 'views/libro/partials/menu.libro.partial.php'; ?>

                <!-- tabla de libros -->
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <!-- Mostramos el encabezado de la tabla -->
                            <tr>
                                <th>Id</th>
                                <th>Titulo</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Fecha Edicion</th>
                                <th>ISBN</th>
                                <th>Autor</th>
                                <th>Editorial</th>
                                <th>Generos</th>
                                <!-- columna de acciones -->
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Mostramos cuerpo de la tabla -->
                            <?php while ($libro = $this->libros->fetch()): ?>
                                <tr class="align-middle">
                                    <!-- Detalles de artículos -->
                                    <td><?= $libro->id ?></td>
                                    <td><?= $libro->titulo ?></td>
                                    <td><?= $libro->precio ?></td>
                                    <td><?= $libro->stock ?></td>
                                    <td><?= $libro->fecha_edicion ?></td>
                                    <td><?= $libro->isbn ?></td>
                                    <td><?= $libro->autor ?></td>
                                    <td><?= $libro->editorial ?></td>
                                    <td><?= $libro->generos ?></td>     

                                    <!-- Columna de acciones -->
                                    <td>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <a href="<?= URL ?>libro/eliminar/<?= $libro->id ?>" title="Eliminar"
                                                class="btn btn-danger"
                                                onclick="return confirm('Confimar elimación del libro')"><i
                                                    class="bi bi-trash-fill"></i></a>
                                            <a href="<?= URL ?>libro/editar/<?= $libro->id ?>" title="Editar"
                                                class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                            <a href="<?= URL ?>libro/mostrar/<?= $libro->id ?>" title="Mostrar"
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
            Nº libros <?= $this->libros->rowCount() ?>
            </div>
        </div>
        <br><br><br>

    </div>

    <!-- /.container -->

    <?php require_once 'template/partials/footer.partial.php' ?>
    <?php require_once 'template/layouts/javascript.layout.php' ?>

</body>

</html>