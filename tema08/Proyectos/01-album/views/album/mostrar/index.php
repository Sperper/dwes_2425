<!doctype html>
<html lang="es">

<head>
    <?php require_once 'template/layouts/head.layout.php'; ?>
    <title><?= $this->title ?> </title>
</head>

<body>
    <!-- Menú fijo superior -->
    <?php require_once 'template/partials/menu.auth.partial.php' ?>

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

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Titulo:</th>
                            <td></td>
                            <td></td>
                            <td><?= htmlspecialchars($this->album->titulo) ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Descripcion:</th>
                            <td></td>
                            <td></td>
                            <td><?= htmlspecialchars($this->album->descripcion) ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Autor:</th>
                            <td></td>
                            <td></td>
                            <td><?= htmlspecialchars($this->album->autor) ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Fecha:</th>
                            <td></td>
                            <td></td>
                            <td><?= htmlspecialchars($this->album->fecha) ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Lugar:</th>
                            <td></td>
                            <td></td>
                            <td><?= htmlspecialchars($this->album->lugar) ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Categoría:</th>
                            <td></td>
                            <td></td>
                            <td><?= htmlspecialchars($this->categorias[$this->album->categoria_id]) ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Número de Fotos:</th>
                            <td></td>
                            <td></td>
                            <td><?= htmlspecialchars($this->album->num_fotos) ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Número de Visitas:</th>
                            <td></td>
                            <td></td>
                            <td><?= htmlspecialchars($this->album->num_visitas) ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Carpeta:</th>
                            <td></td>
                            <td></td>
                            <td><?= htmlspecialchars($this->album->carpeta) ?></td>
                        </tr>
                    </tbody>
                </table>
 
                <h1>IMAGENES</h1>
                <div class="row">
                    <?php foreach ($this->imagenes as $imagen): ?>
                        <div class="col-md-3">
                            <div class="card mb-3">
                                <img src="<?= URL ?>images/<?= $this->album->carpeta ?>/<?= $imagen ?>" class="card-img-top" alt="<?= $imagen ?>">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
                <div class="card-footer">
                    <a class="btn btn-secondary" href="<?= URL ?>album" role="button">Volver</a>
                </div>
            </div>
            <br><br><br>

        </div>


        <?php require_once 'template/partials/footer.partial.php' ?>
        <?php require_once 'template/layouts/javascript.layout.php' ?>

</body>

</html>