<!-- menú principal Autores -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= URL ?>autor">Autores</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link  
                    <?= in_array($_SESSION['role_id'], $GLOBALS['autor']['nuevo']) ? 'active' : 'disabled' ?>"
                        aria-current="page" href="<?= URL ?>autor/nuevo/<?= $_SESSION['csrf_token'] ?>">Nuevo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link 
                    <?= in_array($_SESSION['role_id'], $GLOBALS['autor']['exportar'])? 'active':'disabled' ?>" 
                    href="<?= URL ?>autor/exportar/csv/<?= $_SESSION['csrf_token'] ?>" title="Exportar CSV">Exportar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link 
                    <?= in_array($_SESSION['role_id'], $GLOBALS['autor']['importar'])? 'active':'disabled' ?>" 
                    href="<?= URL ?>autor/importar/csv/<?= $_SESSION['csrf_token'] ?>" title="Importar CSV">Importar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link 
                    <?= in_array($_SESSION['role_id'], $GLOBALS['autor']['pdf'])? 'active':'disabled' ?>" 
                    href="<?= URL ?>autor/pdf/<?= $_SESSION['csrf_token'] ?>" title="Exportar PDF">PDF</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle
                    <?= in_array($_SESSION['role_id'], $GLOBALS['autor']['ordenar']) ? 'active' : 'disabled' ?>"
                        href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Ordenar
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= URL ?>autor/ordenar/1/<?= $_SESSION['csrf_token'] ?>">Id</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>autor/ordenar/2/<?= $_SESSION['csrf_token'] ?>">Nombre</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>autor/ordenar/3/<?= $_SESSION['csrf_token'] ?>">Apellido</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>autor/ordenar/4/<?= $_SESSION['csrf_token'] ?>">Fecha de Nacimiento</a></li>
                        <li><a class="dropdown-item" href="<?= URL ?>autor/ordenar/5/<?= $_SESSION['csrf_token'] ?>">Nacionalidad</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex" role="search" action="autor/filtrar" method="GET">
                <input type="hidden" name="csrf_token"
                    value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="expresion" required>
                <button class="btn btn-outline-primary
                <?= in_array($_SESSION['role_id'], $GLOBALS['autor']['filtrar']) ? null : 'disabled' ?>"
                    type="submit">Buscar</button>
            </form>
        </div>
    </div>
</nav>
