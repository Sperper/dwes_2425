<?php

class Album extends Controller
{

    function __construct()
    {

        parent::__construct();
    }

    /*
        Método principal

        Se  carga siempre que la url contenga sólo el primer parámetro

        url: /alumno
    */
    public function render()
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje de error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        } // Comprobar si el usuario tiene permisos

        else if (!in_array($_SESSION['role_id'], $GLOBALS['album']['main'])) {

            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'auth/login');
            exit();
        }

        // Creo un token CSRF
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        // Compruebo si hay mensaje de éxito
        if (isset($_SESSION['mensaje'])) {

            // Creo la propiedad mensaje en la vista
            $this->view->mensaje = $_SESSION['mensaje'];

            // Elimino la variable de sesión mensaje
            unset($_SESSION['mensaje']);
        }

        // Compruebo si hay mensaje de error
        if (isset($_SESSION['mensaje_error'])) {

            // Creo la propiedad mensaje en la vista
            $this->view->mensaje_error = $_SESSION['mensaje_error'];

            // Elimino la variable de sesión mensaje
            unset($_SESSION['mensaje_error']);
        }


        // Compruebo validación errónea de formulario
        if (isset($_SESSION['error'])) {

            // Creo la propiedad mensaje_error en la vista
            $this->view->mensaje_error = $_SESSION['error'];

            // Elimino la variable de sesión error
            unset($_SESSION['error']);
        }

        // Creo la propiedad title de la vista
        $this->view->title = "Gestión de Album";

        // Creo la propiedad alumnos para usar en la vista
        $this->view->albumes = $this->model->get();

        // Creo la propiedad categorias para usar en la vista
        $this->view->categorias = $this->model->get_categorias();

        $this->view->render('album/main/index');
    }

    /*
        Método nuevo()

        Muestra el formulario que permite añadir nuevo album

        url asociada: /album/nuevo
    */
    public function nuevo()
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }
        // Comprobar si el usuario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['album']['nuevo'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'album');
            exit();
        }

        // Creo un token CSRF
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        // Crear un objeto vacío de la clase alumno
        $this->view->album = new classAlbum();

        // Comrpuebo si hay errores en la validación
        if (isset($_SESSION['error'])) {

            // Creo la propiedad error en la vista
            $this->view->error = $_SESSION['error'];

            // Creo la propiedad alumno en la vista
            $this->view->album = $_SESSION['album'];

            // Creo la propiedad mensaje de error
            $this->view->mensaje_error = 'Error en el formulario';

            // Elimino la variable de sesión error
            unset($_SESSION['error']);

            // Elimino la variable de sesión alumno
            unset($_SESSION['album']);
        }

        // Creo la propiead título
        $this->view->title = "Añadir - Gestión de Albumes";

        // Creo la propiedad categorias para usar en la vista
        $this->view->categorias = $this->model->get_categorias();

        // Cargo la vista asociada a este método
        $this->view->render('album/nuevo/index');
    }

    /*
        Método create()

        Permite añadir nuevo alumno al formulario

        url asociada: /alumno/create
        POST: detalles del alumno
    */
    public function create()
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }
        // Comprobar si el usuario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['album']['nuevo'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'album');
            exit();
        }

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            header('location:' . URL . 'errores');
            exit();
        }

        // Recogemos los detalles del formulario saneados
        // Prevenir ataques XSS
        $titulo = filter_var($_POST['titulo'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
        $descripcion = filter_var($_POST['descripcion'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
        $autor = filter_var($_POST['autor'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
        $fecha = filter_var($_POST['fecha'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
        $lugar = filter_var($_POST['lugar'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
        $categoria_id = filter_var($_POST['categoria_id'] ?? '', FILTER_SANITIZE_NUMBER_INT);
        $carpeta = filter_var($_POST['carpeta'], FILTER_SANITIZE_SPECIAL_CHARS);
        

        // Creamos un objeto de la clase album con los detalles del formulario
        $album = new classAlbum(
            null,
            $titulo,
            $descripcion,
            $autor,
            $fecha,
            $lugar,
            $carpeta,
            0,
            0,
            $categoria_id,
        );

        

        // Validación de los datos

        // Creo un array para almacenar los errores
        $error = [];

        // Validación del título
        if (empty($titulo)) {
            $error['titulo'] = 'El título es obligatorio';
        }

        // Validación de la descripción
        if (empty($descripcion)) {
            $error['descripcion'] = 'La descripción es obligatoria';
        }

        // Validación del autor
        if (empty($autor)) {
            $error['autor'] = 'El autor es obligatorio';
        }

        // Validación de la fecha
        if (empty($fecha)) {
            $error['fecha'] = 'La fecha es obligatoria';
        } else {
            $fechaObj = DateTime::createFromFormat('Y-m-d', $fecha);
            if (!$fechaObj) {
                $error['fecha'] = 'El formato de la fecha no es correcto';
            }
        }

        // Validación del lugar
        if (empty($lugar)) {
            $error['lugar'] = 'El lugar es obligatorio';
        }

        // Validación de la categoría
        if (empty($categoria_id)) {
            $error['categoria_id'] = 'La categoría es obligatoria';
        } else if (!filter_var($categoria_id, FILTER_VALIDATE_INT)) {
            $error['categoria_id'] = 'El formato de la categoría no es correcto';
        }


        // Validación de la carpeta
        if (empty($carpeta)) {
            $error['carpeta'] = 'La carpeta es obligatoria';
        }

        

        // Si hay errores
        if (!empty($error)) {
            // Formulario no ha sido validado
            // Tengo que redireccionar al formulario de nuevo

            // Creo la variable de sessión album con los datos del formulario
            $_SESSION['album'] = $album;

            // Creo la variable de sessión error con los errores
            $_SESSION['error'] = $error;

            // redireciona al formulario de nuevo
            header('location:' . URL . 'album/nuevo');
            exit();
        }

        // var_dump($categoria_id);
        // exit();

        // Añadimos album a la tabla
        $this->model->create($album);

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = 'Álbum añadido con éxito';
        
       

        mkdir("images/" . $carpeta);

        // redireciona al main de album
        header('location:' . URL . 'album');
        exit();
    }

    /*
        Método editar()

        Muestra el formulario que permite editar los detalles de un álbum y agregar imágenes

        url asociada: /album/editar/id/csrf_token

        @param
            - int $id: id del álbum a editar
            - string $csrf_token: token CSRF
    */
    function editar($param = [])
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }
        // Comprobar si el usuario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['album']['editar'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'album');
            exit();
        }

        // obtengo el id del álbum que voy a editar
        $this->view->id = htmlspecialchars($param[0]);

        // obtengo el token CSRF
        $this->view->csrf_token = $param[1];

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $this->view->csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }

        // obtener objeto de la clase album con el id asociado
        $this->view->album = $this->model->read($this->view->id);

        // Comrpuebo si hay errores en la validación
        if (isset($_SESSION['error'])) {
            // Creo la propiedad error en la vista
            $this->view->error = $_SESSION['error'];

            // Creo la propiedad album en la vista
            $this->view->album = $_SESSION['album'];

            // Creo la propiedad mensaje de error
            $this->view->mensaje_error = 'Error en el formulario';

            // Elimino la variable de sesión error
            unset($_SESSION['error']);

            // Elimino la variable de sesión album
            unset($_SESSION['album']);
        }

        // obtener las categorías
        $this->view->categorias = $this->model->get_categorias();

        // title
        $this->view->title = "Formulario Editar Álbum";

        // cargo la vista
        $this->view->render('album/editar/index');
    }

    /*
        Método update()

        Actualiza los detalles de un álbum y agrega imágenes

        url asociada: /album/update/id

        POST: detalles del álbum

        @param int $id: id del álbum a editar
    */
    public function update($param = [])
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }
        // Comprobar si el usuario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['album']['editar'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'album');
            exit();
        }

        // obtengo el id del álbum que voy a editar
        $id = htmlspecialchars($param[0]);

        // obtengo el token CSRF
        $csrf_token = $param[1];

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }

        // Recogemos los detalles del formulario saneados
        // Prevenir ataques XSS
        $titulo = filter_var($_POST['titulo'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
        $descripcion = filter_var($_POST['descripcion'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
        $autor = filter_var($_POST['autor'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
        $fecha = filter_var($_POST['fecha'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
        $lugar = filter_var($_POST['lugar'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
        $categoria_id = filter_var($_POST['categoria_id'] ?? '', FILTER_SANITIZE_NUMBER_INT);

        // Creo un objeto de la clase album con los detalles del formulario
        $album_form = new classAlbum(
            $id,
            $titulo,
            $descripcion,
            $autor,
            $fecha,
            $lugar,
            $categoria_id,
            0,
            0,
            null
        );

        // Obtengo los detalles del álbum de la base de datos
        $album = $this->model->read($id);

        // Validación de los datos
        $error = [];

        // Validación del título
        if (empty($titulo)) {
            $error['titulo'] = 'El título es obligatorio';
        }

        // Validación de la descripción
        if (empty($descripcion)) {
            $error['descripcion'] = 'La descripción es obligatoria';
        }

        // Validación del autor
        if (empty($autor)) {
            $error['autor'] = 'El autor es obligatorio';
        }

        // Validación de la fecha
        if (empty($fecha)) {
            $error['fecha'] = 'La fecha es obligatoria';
        } else {
            $fechaObj = DateTime::createFromFormat('Y-m-d', $fecha);
            if (!$fechaObj) {
                $error['fecha'] = 'El formato de la fecha no es correcto';
            }
        }

        // Validación del lugar
        if (empty($lugar)) {
            $error['lugar'] = 'El lugar es obligatorio';
        }

        // Validación de la categoría
        if (empty($categoria_id)) {
            $error['categoria_id'] = 'La categoría es obligatoria';
        } else if (!filter_var($categoria_id, FILTER_VALIDATE_INT)) {
            $error['categoria_id'] = 'El formato de la categoría no es correcto';
        }

        // Si hay errores
        if (!empty($error)) {
            // Formulario no ha sido validado
            // Tengo que redireccionar al formulario de nuevo

            // Creo la variable de sessión album con los datos del formulario
            $_SESSION['album'] = $album_form;

            // Creo la variable de sessión error con los errores
            $_SESSION['error'] = $error;

            // redireciona al formulario de nuevo
            header('location:' . URL . 'album/editar/' . $id . '/' . $csrf_token);
            exit();
        }

        // Actualizo los detalles del álbum
        $this->model->update($album_form, $id);

        // Validaciones de las imágenes
        $error = [];
        $maxFileSize = 5 * 1024 * 1024; // 5MB
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

        foreach ($_FILES['imagenes']['tmp_name'] as $key => $tmp_name) {
            $fileSize = $_FILES['imagenes']['size'][$key];
            $fileType = $_FILES['imagenes']['type'][$key];

            if ($fileSize > $maxFileSize) {
                $error[] = 'El tamaño de la imagen no debe superar los 5MB';
            }

            if (!in_array($fileType, $allowedTypes)) {
                $error[] = 'El tipo de archivo no es válido. Solo se permiten JPG, PNG y GIF';
            }
        }

        // Si hay errores
        if (!empty($error)) {
            $_SESSION['error'] = $error;
            header('location:' . URL . 'album/editar/' . $id . '/' . $csrf_token);
            exit();
        }

        // Guardar las imágenes
        $carpeta = 'images/' . $album->carpeta;
        foreach ($_FILES['imagenes']['tmp_name'] as $key => $tmp_name) {
            $fileName = basename($_FILES['imagenes']['name'][$key]);
            move_uploaded_file($tmp_name, $carpeta . '/' . $fileName);
        }

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = 'Álbum actualizado con éxito';

        // redireciona al main de album
        header('location:' . URL . 'album');
        exit();
    }

    

    /*
        Método filtrar()

        Busca un alumno en la base de datos

        url asociada: /alumno/filtrar/expresion

        GET: 
            - expresion de búsqueda

        DEVUELVE:
            - PDOStatement con los alumnos que coinciden con la expresión de búsqueda
    */
    public function filtrar()
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }
        // Comprobar si el usuario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['alumno']['filtrar'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'alumno');
            exit();
        }

        # Obtengo la expresión de búsqueda
        $expresion = htmlspecialchars($_GET['expresion']);

        // obtengo el token CSRF
        $csrf_token = htmlspecialchars($_GET['csrf_token']);

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }

        # Cargo el título
        $this->view->title = "Filtrar por: {$expresion} - Gestión de Alumnos";

        # Obtengo los alumnos que coinciden con la expresión de búsqueda
        $this->view->alumnos = $this->model->filter($expresion);

        # Cargo la vista
        $this->view->render('alumno/main/index');
    }

    /*
        Método ordenar()

        Ordena los alumnos de la base de datos

        url asociada: /alumno/ordenar/id

        @param
            :int $id: id del campo por el que se ordenarán los alumnos
    */
    public function ordenar($param = [])
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }
        // Comprobar si el usuario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['alumno']['ordenar'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'alumno');
            exit();
        }

        // Obtener criterio
        $id = (int) htmlspecialchars($param[0]);

        // Obtener csrf_token
        $csrf_token = $param[1];

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }

        # Criterios de ordenación
        $criterios = [
            1 => 'ID',
            2 => 'Alumno',
            3 => 'Email',
            4 => 'Teléfono',
            5 => 'Nacionalidad',
            6 => 'DNI',
            7 => 'Curso',
            8 => 'Edad'
        ];

        # Cargo el título
        $this->view->title = "Ordenar por {$criterios[$id]} - Gestión de Alumnos";

        # Obtengo los alumnos ordenados por el campo id
        $this->view->alumnos = $this->model->order($id);

        # Cargo la vista
        $this->view->render('alumno/main/index');
    }

    public function agregar_imagenes($param = [])
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }

        // Comprobar si el usuario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['album']['editar'])) {
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'album');
            exit();
        }

        // Creo un token CSRF
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        // obtengo el id del álbum
        $this->view->id = htmlspecialchars($param[0]);

        // obtengo el token CSRF
        $this->view->csrf_token = $param[1];

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $this->view->csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }

        // obtener objeto de la clase album con el id asociado
        $this->view->album = $this->model->read($this->view->id);

        // Creo la propiead título
        $this->view->title = "Agregar Imágenes - Gestión de Albumes";

        // Cargo la vista asociada a este método
        $this->view->render('album/agregar_imagenes/index');
    }

    public function guardar_imagenes()
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }

        // Comprobar si el usuario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['album']['agregar'])) {
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'album');
            exit();
        }

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            header('location:' . URL . 'errores');
            exit();
        }

        // obtengo el id del álbum
        $id = htmlspecialchars($_POST['id']);

        // obtengo el token CSRF
        $csrf_token = $_POST['csrf_token'];

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }

        // obtener objeto de la clase album con el id asociado
        $album = $this->model->read($id);

        // Validaciones de las imágenes
        $error = [];
        $maxFileSize = 5 * 1024 * 1024; // 5MB
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

        foreach ($_FILES['imagenes']['tmp_name'] as $key => $tmp_name) {
            $fileSize = $_FILES['imagenes']['size'][$key];
            $fileType = $_FILES['imagenes']['type'][$key];

            if ($fileSize > $maxFileSize) {
                $error[] = 'El tamaño de la imagen no debe superar los 5MB';
            }

            if (!in_array($fileType, $allowedTypes)) {
                $error[] = 'El tipo de archivo no es válido. Solo se permiten JPG, PNG y GIF';
            }
        }

        // Si hay errores
        if (!empty($error)) {
            $_SESSION['error'] = $error;
            header('location:' . URL . 'album/agregar_imagenes/' . $id . '/' . $csrf_token);
            exit();
        }

        // Guardar las imágenes
        $carpeta = 'images/' . $album->carpeta;
        foreach ($_FILES['imagenes']['tmp_name'] as $key => $tmp_name) {
            $fileName = basename($_FILES['imagenes']['name'][$key]);
            move_uploaded_file($tmp_name, $carpeta . '/' . $fileName);
        }

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = 'Imágenes añadidas con éxito';

        // redireciona al main de album
        header('location:' . URL . 'album');
        exit();
    }

    public function eliminar($param = [])
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }

        // Comprobar si el usuario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['album']['eliminar'])) {
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'album');
            exit();
        }

        // obtengo el id del álbum que voy a eliminar
        $id = htmlspecialchars($param[0]);

        // obtengo el token CSRF
        $csrf_token = $param[1];

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }

        // Validar id del álbum
        if (!$this->model->validateIdAlbum($id)) {
            $_SESSION['error'] = 'ID no válido';
            header('location:' . URL . 'album');
            exit();
        }

        // Id ha sido validado
        // Elimino el álbum de la base de datos
        $album = $this->model->read($id);
        $this->model->delete($id);

        // Elimino la carpeta del álbum
        $carpeta = 'images/' . $album->carpeta;
        array_map('unlink', glob("$carpeta/*.*"));
        rmdir($carpeta);

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = 'Álbum eliminado con éxito';

        // redireciona al main de album
        header('location:' . URL . 'album');
    }

    public function mostrar($param = [])
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }

        // Comprobar si el usuario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['album']['mostrar'])) {
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'album');
            exit();
        }

        // obtengo el id del álbum que voy a mostrar
        $id = htmlspecialchars($param[0]);

        // obtengo el token CSRF
        $csrf_token = $param[1];

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }

        // Validar id del álbum
        if (!$this->model->validateIdAlbum($id)) {
            $_SESSION['error'] = 'ID no válido';
            header('location:' . URL . 'album');
            exit();
        }

        // Cargo el título
        $this->view->title = "Mostrar - Gestión de Álbumes";

        // Obtengo los detalles del álbum mediante el método read del modelo
        $this->view->album = $this->model->read($id);

        // Obtengo las imágenes del álbum
        $carpeta = 'images/' . $this->view->album->carpeta;
        $this->view->imagenes = array_diff(scandir($carpeta), ['.', '..']);

        // Cargo la vista
        $this->view->render('album/mostrar/index');
    }
}
