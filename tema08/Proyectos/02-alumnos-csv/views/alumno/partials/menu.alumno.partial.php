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
                    <a class="nav-link 
                    <?= in_array($_SESSION['role_id'], $GLOBALS['alumno']['nuevo'])? 'active':'disabled' ?>" 
                    aria-current="page" href="<?= URL ?>alumno/nuevo">Nuevo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link 
                    <?= in_array($_SESSION['role_id'], $GLOBALS['alumno']['exportar'])? 'active':'disabled' ?>" 
                    href="<?= URL ?>alumno/exportar/csv/<?= $_SESSION['csrf_token'] ?>" title="Exportar CSV">Exportar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link 
                    <?= in_array($_SESSION['role_id'], $GLOBALS['alumno']['importar'])? 'active':'disabled' ?>" 
                    href="<?= URL ?>alumno/importar/csv/<?= $_SESSION['csrf_token'] ?>" title="Importar CSV">Importar</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle
                    <?= in_array($_SESSION['role_id'], $GLOBALS['alumno']['ordenar'])? 'active':'disabled' ?>" 
                    href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Ordenar
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= URL ?>alumno/ordenar/1/<?= $_SESSION['csrf_token'] ?>">Id</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>alumno/ordenar/2/<?= $_SESSION['csrf_token']?>">Alumno</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>alumno/ordenar/3/<?= $_SESSION['csrf_token']?>">Email</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>alumno/ordenar/4/<?= $_SESSION['csrf_token']?>">Teléfono</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>alumno/ordenar/5/<?= $_SESSION['csrf_token']?>">Nacionalidad</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>alumno/ordenar/6/<?= $_SESSION['csrf_token']?>">DNI</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>alumno/ordenar/7/<?= $_SESSION['csrf_token']?>">Curso</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>alumno/ordenar/8/<?= $_SESSION['csrf_token']?>">Edad</a></li>
                        
                    </ul>
                </li>

            </ul>
            <form class="d-flex" role="search" action="<?= URL ?>alumno/filtrar" method="GET">
                
            <!-- protección CSRF -->
                <input type="hidden" name="csrf_token"
                        value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">
                
                        <!-- expresión    -->
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="expresion" required>
                
                <!-- botones de accion -->
                <button class="btn btn-outline-primary 
                <?= in_array($_SESSION['role_id'], $GLOBALS['alumno']['filtrar'])? null:'disabled' ?>" 
                type="submit">Buscar</button>
            </form>
        </div>
    </div>
</nav>