<!doctype html>
<html lang="es">

<head>
    <?php require_once 'template/layouts/head.layout.php'; ?>
    <title><?= $this->title ?> </title>
</head>

<body>
    <!-- Menú fijo superior -->
    <?php require_once 'template/partials/menu.partial.php' ?>

    <!-- Capa Principal -->
    <div class="container">
        <br><br><br><br>

        <!-- capa de mensajes -->
        <?php require_once 'template/partials/mensaje.partial.php' ?>

        <!-- capa errores -->
        <?php require_once 'template/partials/error.partial.php' ?>

        <!-- Estilo card de bootstrap -->
        <div class="card">
            <div class="card-header">
                <!-- Protección ataques XSS -->
                <h5 class="card-title"><?= htmlspecialchars($this->title) ?></h5>
            </div>
            <div class="card-body">
                <!-- Formulario de alumnos  -->
                <form action="<?= URL ?>alumno/create" method="POST">

                    <!-- protección CSRF -->
                    <input type="hidden" name="csrf_token"
                        value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">

                    <!-- Nombre -->
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control
                            <?= (isset($this->error['nombre']))? 'is-invalid': null ?>" 
                            id="nombre" name="nombre"
                            placeholder="Introduzca nombre" value="<?= htmlspecialchars($this->alumno->nombre) ?>"
                            required>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['nombre'] ??= null ?>
                        </span>
                    </div>
                    <!-- Apellidos -->
                    <div class="mb-3">
                        <label for="apellidos" class="form-label">Apellidos</label>
                        <input type="text" class="form-control
                            <?= (isset($this->error['apellidos']))? 'is-invalid': null ?>" 
                            id="apellidos" name="apellidos"
                            placeholder="Introduzca apellidos" value="<?= htmlspecialchars($this->alumno->apellidos) ?>"
                            required>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['apellidos'] ??= null ?>
                        </span>   
                    </div>
                    <!-- Fecha Nacimiento -->
                    <div class="mb-3">
                        <label for="fechaNac" class="form-label">Fecha Nacimiento</label>
                        <input type="date" class="form-control 
                            <?= (isset($this->error['fechaNac']))? 'is-invalid': null ?>" 
                            id="fechaNac" name="fechaNac"
                            value="<?= htmlspecialchars($this->alumno->fechaNac) ?>" required>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['fechaNac'] ??= null ?>
                        </span>
                    </div>
                    <!-- Dni -->
                    <div class="mb-3">
                        <label for="dni" class="form-label">Dni</label>
                        <input type="text" class="form-control 
                            <?= (isset($this->error['dni']))? 'is-invalid': null ?>" 
                            id="dni" name="dni"
                            placeholder="11111111A" value="<?= htmlspecialchars($this->alumno->dni) ?>" 
                            required pattern="^[0-9]{8}[A-Za-z]{1}$" title="8 dígitos y una letra">
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['dni'] ??= null ?>
                        </span> 
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control 
                            <?= (isset($this->error['email']))? 'is-invalid': null ?>" 
                            id="email" name="email"
                            placeholder="email@ejemplo.es" value="<?= htmlspecialchars($this->alumno->email) ?>"
                            required>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['email'] ??= null ?>
                        </span>
                    </div>
                    <!-- Telefono -->
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="tel" class="form-control 
                            <?= (isset($this->error['telefono']))? 'is-invalid': null ?>" 
                            id="telefono" name="telefono"
                            placeholder="666666666" value="<?= htmlspecialchars($this->alumno->telefono) ?>"
                            required title="9 dígitos">
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['telefono'] ??= null ?>
                        </span>
                    </div>
                    <!-- Nacionalidad -->
                    <div class="mb-3">
                        <label for="nacionalidad" class="form-label">Nacionalidad</label>
                        <input type="text" class="form-control 
                            <?= (isset($this->error['nacionalidad']))? 'is-invalid': null ?>" 
                            id="nacionalidad" name="nacionalidad"
                            placeholder="Introduzca nacionalidad" 
                            value="<?= htmlspecialchars($this->alumno->nacionalidad) ?>">
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['nacionalidad'] ??= null ?>
                        </span>
                    </div>

                    <!-- Select Dinámico Cursos -->
                    <div class="mb-3">
                        <label for="id_curso" class="form-label">Curso</label>
                        <select class="form-select 
                            <?= (isset($this->error['id_curso']))? 'is-invalid': null ?>" 
                            id="id_curso" name="id_curso" required>
                            <option selected disabled>Seleccione curso</option>
                            <!-- mostrar lista cucrsos -->
                            <?php foreach ($this->cursos as $indice => $data): ?>
                                <option value="<?= $indice ?>" <?= $this->alumno->id_curso == $indice ? 'selected' : '' ?>>
                                    <?= $data ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['id_curso'] ??= null ?>
                        </span>
                    </div>
            </div>
            <div class="card-footer">
                <!-- botones de acción -->
                <a class="btn btn-secondary" href="<?= URL ?>alumno" role="button" 
                onclick="return confirm('¿Estás seguro de que deseas cancelar? Se perderán los datos ingresados.')">Cancelar</a>
                <button type="reset" class="btn btn-danger">Borrar</button>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
            </form>
            <!-- Fin formulario nuevo artículo -->
        </div>
        <br><br><br>

    </div>

    <!-- /.container -->

    <?php require_once 'template/partials/footer.partial.php' ?>
    <?php require_once 'template/layouts/javascript.layout.php' ?>

</body>

</html>