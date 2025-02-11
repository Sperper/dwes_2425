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
                <!-- Detalles del álbum -->
                <p><strong>Título:</strong> <?= htmlspecialchars($this->album->titulo) ?></p>
                <p><strong>Descripción:</strong> <?= htmlspecialchars($this->album->descripcion) ?></p>
                <p><strong>Autor:</strong> <?= htmlspecialchars($this->album->autor) ?></p>
                <p><strong>Fecha:</strong> <?= htmlspecialchars($this->album->fecha) ?></p>
                <p><strong>Lugar:</strong> <?= htmlspecialchars($this->album->lugar) ?></p>
                <p><strong>Categoría:</strong> <?= htmlspecialchars($this->categorias[$this->album->categoria_id]) ?></p>
                <p><strong>Etiquetas:</strong> <?= htmlspecialchars($this->album->etiquetas) ?></p>
                <p><strong>Número de Fotos:</strong> <?= htmlspecialchars($this->album->num_fotos) ?></p>
                <p><strong>Número de Visitas:</strong> <?= htmlspecialchars($this->album->num_visitas) ?></p>
                <p><strong>Carpeta:</strong> <?= htmlspecialchars($this->album->carpeta) ?></p>

                <!-- Imágenes del álbum -->
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

    <!-- /.container -->

    <?php require_once 'template/partials/footer.partial.php' ?>
    <?php require_once 'template/layouts/javascript.layout.php' ?>

</body>

</html>