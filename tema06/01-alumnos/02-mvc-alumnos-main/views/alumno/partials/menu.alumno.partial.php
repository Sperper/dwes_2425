<!-- menú principal Artículos -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= URL ?>alumno">Alumnos</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= URL ?>alumno/nuevo">Nuevo</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Ordenar
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="ordenar.php?criterio=1">Id</a></li>
                        <li><a class="dropdown-item" href="ordenar.php?criterio=2">Nombre</a></li>
                        <li><a class="dropdown-item" href="ordenar.php?criterio=3">Apellidos</a></li>
                        <li><a class="dropdown-item" href="ordenar.php?criterio=4">Email</a></li>
                        <li><a class="dropdown-item" href="ordenar.php?criterio=5">Teléfono</a></li>
                        <li><a class="dropdown-item" href="ordenar.php?criterio=6">Nacionalidad</a></li>
                        <li><a class="dropdown-item" href="ordenar.php?criterio=7">DNI</a></li>
                        <li><a class="dropdown-item" href="ordenar.php?criterio=8">Edad</a></li>
                        <li><a class="dropdown-item" href="ordenar.php?criterio=9">Curso</a></li>
                    </ul>
                </li>

            </ul>
            <form class="d-flex" role="search" action="filtrar.php" method="GET">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="expresion" required>
                <button class="btn btn-outline-primary" type="submit">Buscar</button>
            </form>
        </div>
    </div>
</nav>