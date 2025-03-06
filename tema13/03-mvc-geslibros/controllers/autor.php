<?php

class Autor extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    /*
        Método checkLogin()

        Permite checkear si el usuario está logueado, si no está logueado 
        redirecciona a la página de login

    */
    public function checkLogin()
    {

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }
    }

    /*
        Método checkPermissions()

        Permite checkear si el usuario tiene permisos suficientes para acceder a una página

        @param
            - array $roles: roles permitidos
    */
    public function checkPermissions($priviliges)
    {

        // Comprobar si el usuario tiene permisos
        if (!in_array($_SESSION['role_id'], $priviliges)) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'libro');
            exit();
        }
    }

    /*
        Método checkTokenCsrf()

        Permite checkear si el token CSRF es válido

        @param
            - string $csrf_token: token CSRF
    */
    public function checkTokenCsrf($csrf_token)
    {

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }
    }

    /*
        Método principal

        Se carga siempre que la url contenga sólo el primer parámetro

        url: /autor
    */
    public function render()
    {
        // inicio o continuo la sesión
        session_start();

        // Creo un token CSRF
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['autor']['main']);

        // Compruebo si hay mensajes de éxito
        if (isset($_SESSION['success'])) {

            // Creo la propiedad success de la vista
            $this->view->success = $_SESSION['success'];

            // Elimino la variable de sesión
            unset($_SESSION['success']);
        }

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
        $this->view->title = "Gestión de Autores";

        // Creo la propiedad autores para usar en la vista
        $this->view->autores = $this->model->get();

        // Cargo la vista asociada a este método
        $this->view->render('autor/main/index');
    }

    /*
        Método nuevo()

        Muestra el formulario que permite añadir nuevo autor

        url asociada: /autor/nuevo
    */
    public function nuevo($param = [])
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['autor']['nuevo']);

        // Validar token
        $this->checkTokenCsrf($param[0]);

        // Creo un objeto vacío de la clase autor
        $this->view->autor = new classAutor();

        // Compruebo si hay errores de validación
        if (isset($_SESSION['error'])) {

            // Creo la propiedad error de la vista
            $this->view->error = $_SESSION['error'];

            // Creo la propiedad autor de la vista
            $this->view->autor = $_SESSION['autor'];

            // Creo la propiedad mensaje de error
            $this->view->mensaje = 'Error en el formulario';

            // Elimino la variable de sesión autor
            unset($_SESSION['autor']);

            // Elimino la variable de sesión error
            unset($_SESSION['errores']);
        }

        // Creo la propiedad título
        $this->view->title = "Añadir - Gestión de Autores";

        // Cargo la vista asociada a este método
        $this->view->render('autor/nuevo/index');
    }

    /*
        Método create()

        Permite añadir nuevo autor al formulario

        url asociada: /autor/create
        POST: detalles del autor
    */
    public function create()
    {

        // inicio o continuo la sesión
        session_start();

        // Validar token
        $this->checkTokenCsrf($_POST['csrf_token']);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Recogemos los detalles del formulario
        // Prevenir ataques XSS
        $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_SPECIAL_CHARS);
        $nacionalidad = filter_var($_POST['nacionalidad'], FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS);
        $fecha_nac = filter_var($_POST['fecha_nac'], FILTER_SANITIZE_SPECIAL_CHARS);
        $fecha_def = filter_var($_POST['fecha_def'], FILTER_SANITIZE_SPECIAL_CHARS);
        $premios = filter_var($_POST['premios'], FILTER_SANITIZE_SPECIAL_CHARS);

        // Creamos un objeto de la clase autor con los detalles del formulario  
        $autor = new classAutor(
            null,
            $nombre,
            $nacionalidad,
            $email,
            $fecha_nac,
            $fecha_def,
            $premios
        );

        // Validación de los datos

        // Creo un array para almacenar los errores
        $error = [];

        // Validación del nombre
        // Reglas: obligatorio
        if (empty($nombre)) {
            $error['nombre'] = 'El nombre es obligatorio';
        }

        // Validación de la nacionalidad
        // Reglas: obligatorio
        if (empty($nacionalidad)) {
            $error['nacionalidad'] = 'La nacionalidad es obligatoria';
        }

        // Validación de la fecha de nacimiento
        // Reglas: obligatorio
        if (empty($fecha_nac)) {
            $error['fecha_nac'] = 'La fecha de nacimiento es obligatoria';
        }

        // Validación de la fecha de defunción
        // Reglas: opcional
        if (!empty($fecha_def) && !strtotime($fecha_def)) {
            $error['fecha_def'] = 'La fecha de defunción no es válida';
        }

        // Validación de los premios
        // Reglas: opcional
        if (!empty($premios) && strlen($premios) > 255) {
            $error['premios'] = 'Los premios no pueden exceder los 255 caracteres';
        }

        // Si hay errores
        if (!empty($error)) {

            // Creo la variable de sesión error
            $_SESSION['error'] = $error;

            // Creo la variable de sesión autor
            $_SESSION['autor'] = $autor;

            // Redirecciono al formulario de nuevo
            header('location:' . URL . 'autor/nuevo/' . $_SESSION['csrf_token']);

            //
            // redireciona al main de autor
            header('location:' . URL . 'autor');
            exit();
        }

        // Añadimos libro a la tabla
        $this->model->create($autor);

        // Genero un mensaje de éxito
        $_SESSION['mensaje'] = 'Autor añadido con éxito';
 
        // redireciona al main de libro
        header('location:' . URL . 'autor');
     exit();
    }

    /*
        Método editar()

        Muestra el formulario que permite editar los detalles de un autor

        url asociada: /autor/editar/id

        @param int $id: id del autor a editar

    */
    public function editar($param = [])
    {

        # obtengo el id del autor que voy a editar
        // autor/edit/4
        // -- autor es el nombre del controlador
        // -- edit es el nombre del método
        // -- $param es un array porque puedo pasar varios parámetros a un método

        session_start();

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['autor']['editar']);

        // Validar token
        $this->checkTokenCsrf($param[1]);

        $this->view->id = htmlspecialchars($param[0]);

        # obtener objeto de la clase autor con el id asociado
        $this->view->autor = $this->model->read($this->view->id);

        // Compruebo si hay errores de validación
        if (isset($_SESSION['error'])) {

            // Creo la propiedad error de la vista
            $this->view->error = $_SESSION['error'];

            // Creo la propiedad autor de la vista
            $this->view->autor = $_SESSION['autor'];

            // Creo la propiedad mensaje de error
            $this->view->mensaje = 'Error en el formulario';

            // Elimino la variable de sesión autor
            unset($_SESSION['autor']);

            // Elimino la variable de sesión error
            unset($_SESSION['error']);
        }

        # title
        $this->view->title = "Formulario Editar - Gestión de Autores";

        # obtener objeto de la clase autor con el id pasado
        // Necesito crear el método read en el modelo
        $this->view->autor = $this->model->read($this->view->id);

        # cargo la vista
        $this->view->render('autor/editar/index');
    }
}
