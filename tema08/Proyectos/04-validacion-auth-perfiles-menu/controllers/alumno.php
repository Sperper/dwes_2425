<?php

class Alumno extends Controller
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

        else if (!in_array($_SESSION['role_id'], $GLOBALS['alumno']['main'])) {

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
        $this->view->title = "Gestión de Alumnos";

        // Creo la propiedad alumnos para usar en la vista
        $this->view->alumnos = $this->model->get();

        $this->view->render('alumno/main/index');
    }

    /*
        Método nuevo()

        Muestra el formulario que permite añadir nuevo alumno

        url asociada: /alumno/nuevo
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
        else if (!in_array($_SESSION['role_id'], $GLOBALS['alumno']['nuevo'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'alumno');
            exit();
        }

        // Creo un token CSRF
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        // Crear un objeto vacío de la clase alumno
        $this->view->alumno = new classAlumno();

        // Comrpuebo si hay errores en la validación
        if (isset($_SESSION['error'])) {

            // Creo la propiedad error en la vista
            $this->view->error = $_SESSION['error'];

            // Creo la propiedad alumno en la vista
            $this->view->alumno = $_SESSION['alumno'];

            // Creo la propiedad mensaje de error
            $this->view->mensaje_error = 'Error en el formulario';

            // Elimino la variable de sesión error
            unset($_SESSION['error']);

            // Elimino la variable de sesión alumno
            unset($_SESSION['alumno']);
        }

        // Creo la propiead título
        $this->view->title = "Añadir - Gestión de Alumnos";

        // Creo la propiedad cursos en la vista
        $this->view->cursos = $this->model->get_cursos();

        // Cargo la vista asociada a este método
        $this->view->render('alumno/nuevo/index');
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
        else if (!in_array($_SESSION['role_id'], $GLOBALS['alumno']['nuevo'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'alumno');
            exit();
        }

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            // require_once 'controllers/error.php';
            // $controller = new Errores('Petición no válida');
            // exit();
            header('location:' . URL . 'errores');
            exit();
        }

        // Recogemos los detalles del formulario saneados
        // Prevenir ataques XSS
        $nombre = filter_var($_POST['nombre'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $apellidos = filter_var($_POST['apellidos'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $fechaNac = filter_var($_POST['fechaNac'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $dni = filter_var($_POST['dni'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
        $telefono = filter_var($_POST['telefono'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $nacionalidad = filter_var($_POST['nacionalidad'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $id_curso = filter_var($_POST['id_curso'] ??= '', FILTER_SANITIZE_NUMBER_INT);

        // Creamos un objeto de la clase alumno con los detalles del formulario
        $alumno = new classAlumno(
            null,
            $nombre,
            $apellidos,
            $email,
            $telefono,
            null,
            null,
            null,
            $nacionalidad,
            $dni,
            $fechaNac,
            $id_curso
        );

        // Validación de los datos

        // Creo un array para almacenar los errores
        $error = [];

        // Validación del nombre
        // Reglas: obligatorio
        if (empty($nombre)) {
            $error['nombre'] = 'El nombre es obligatorio';
        }

        // Validación de los apellidos
        // Reglas: obligatorio
        if (empty($apellidos)) {
            $error['apellidos'] = 'Los apellidos son obligatorios';
        }

        // Validación de la fecha de nacimiento
        // Reglas: obligatorio, formato fecha
        if (empty($fechaNac)) {
            $error['fechaNac'] = 'La fecha de nacimiento es obligatoria';
        } else {
            $fecha = DateTime::createFromFormat('Y-m-d', $fechaNac);
            if (!$fecha) {
                $error['fechaNac'] = 'El formato de la fecha de nacimiento no es correcto';
            }
        }

        // Validación del DNI
        // Reglas: obligatorio, formato DNI y clave secundaria

        // Expresión regular para validar el DNI
        // 8 números seguidos de una letra
        $options = [
            'options' => [
                'regexp' => '/^(\d{8})([A-Za-z])$/'
            ]
        ];

        if (empty($dni)) {
            $error['dni'] = 'El DNI es obligatorio';
        } else if (!filter_var($dni, FILTER_VALIDATE_REGEXP, $options)) {
            $error['dni'] = 'Formato DNI no es correcto';
        } else if (!$this->model->validateUniqueDNI($dni)) {
            $error['dni'] = 'El DNI ya existe';
        }

        // Validación del email
        // Reglas: obligatorio, formato email y clave secundaria
        if (empty($email)) {
            $error['email'] = 'El email es obligatorio';
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = 'El formato del email no es correcto';
        } else if (!$this->model->validateUniqueEmail($email)) {
            $error['email'] = 'El email ya existe';
        }

        // Validación del teléfono
        // Reglas: obligatorio, formato teléfono
        if (empty($telefono)) {
            $error['telefono'] = 'El teléfono es obligatorio';
        } else if (!preg_match('/^\d{9}$/', $telefono)) {
            $error['telefono'] = 'El formato del teléfono no es correcto';
        }

        // Validación de la nacionalidad
        // Reglas: No obligatorio

        // Validación id_curso
        // Reglas: obligatorio, entero, clave ajena
        if (empty($id_curso)) {
            $error['id_curso'] = 'El curso es obligatorio';
        } else if (!filter_var($id_curso, FILTER_VALIDATE_INT)) {
            $error['id_curso'] = 'El formato del curso no es correcto';
        } else if (!$this->model->validateForeignKeyCurso($id_curso)) {
            $error['id_curso'] = 'El curso no existe';
        }

        // Si hay errores
        if (!empty($error)) {

            // Formulario no ha sido validado
            // Tengo que redireccionar al formulario de nuevo

            // Creo la variable de sessión alumno con los datos del formulario
            $_SESSION['alumno'] = $alumno;

            // Creo la variable de sessión error con los errores
            $_SESSION['error'] = $error;

            // redireciona al formulario de nuevo
            header('location:' . URL . 'alumno/nuevo');
            exit();
        }

        // Añadimos alumno a la tabla
        $this->model->create($alumno);

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = 'Alumno añadido con éxito';

        // redireciona al main de alumno
        header('location:' . URL . 'alumno');
        exit();
    }

    /*
        Método editar()

        Muestra el formulario que permite editar los detalles de un alumno

        url asociada: /alumno/editar/id/csrf_token

        @param
            - int $id: id del alumno a editar
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
        else if (!in_array($_SESSION['role_id'], $GLOBALS['alumno']['editar'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'alumno');
            exit();
        }

        # obtengo el id del alumno que voy a editar
        // alumno/edit/4
        $this->view->id = htmlspecialchars($param[0]);

        # obtengo el token CSRF
        $this->view->csrf_token = $param[1];

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $this->view->csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }

        # obtener objeto de la clase alumno con el id asociado
        $this->view->alumno = $this->model->read($this->view->id);

        // Comrpuebo si hay errores en la validación
        if (isset($_SESSION['error'])) {

            // Creo la propiedad error en la vista
            $this->view->error = $_SESSION['error'];

            // Creo la propiedad alumno en la vista
            $this->view->alumno = $_SESSION['alumno'];

            // Creo la propiedad mensaje de error
            $this->view->mensaje_error = 'Error en el formulario';

            // Elimino la variable de sesión error
            unset($_SESSION['error']);

            // Elimino la variable de sesión alumno
            unset($_SESSION['alumno']);
        }

        # obtener los cursos
        $this->view->cursos = $this->model->get_cursos();

        # title
        $this->view->title = "Formulario Editar Alumno";

        # cargo la vista
        $this->view->render('alumno/editar/index');
    }

    /*
        Método update()

        Actualiza los detalles de un alumno

        url asociada: /alumno/update/id

        POST: detalles del alumno

        @param int $id: id del alumno a editar
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
        else if (!in_array($_SESSION['role_id'], $GLOBALS['alumno']['editar'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'alumno');
            exit();
        }

        // obtengo el id del alumno que voy a editar
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
        $nombre = filter_var($_POST['nombre'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $apellidos = filter_var($_POST['apellidos'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $fechaNac = filter_var($_POST['fechaNac'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $dni = filter_var($_POST['dni'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
        $telefono = filter_var($_POST['telefono'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $nacionalidad = filter_var($_POST['nacionalidad'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $id_curso = filter_var($_POST['id_curso'] ??= '', FILTER_SANITIZE_NUMBER_INT);

        // Creo un objeto de la clase alumno con los detalles del formulario
        // Actualizo los detalles del alumno
        $alumno_form = new classAlumno(
            $id,
            $nombre,
            $apellidos,
            $email,
            $telefono,
            null,
            null,
            null,
            $nacionalidad,
            $dni,
            $fechaNac,
            $id_curso
        );

        // Obtengo los detalles del alumno de la base de datos
        $alumno = $this->model->read($id);

        // Validación de los datos
        // Valido en caso de que haya sufrido modificaciones el campo correspondiente
        $error = [];

        // Control de cambios en los campos
        $cambios = false;

        // Validación del nombre
        // Reglas: obligatorio
        if (strcmp($nombre, $alumno->nombre) != 0) {
            $cambios = true;
            if (empty($nombre)) {
                $error['nombre'] = 'El nombre es obligatorio';
            }
        }

        // Validación de los apellidos
        // Reglas: obligatorio
        if (strcmp($apellidos, $alumno->apellidos) != 0) {
            $cambios = true;
            if (empty($apellidos)) {
                $error['apellidos'] = 'Los apellidos son obligatorios';
            }
        }

        // Validación de la fecha de nacimiento
        // Reglas: obligatorio, formato fecha
        if (strcmp($fechaNac, $alumno->fechaNac) != 0) {
            $cambios = true;
            if (empty($fechaNac)) {
                $error['fechaNac'] = 'La fecha de nacimiento es obligatoria';
            } else {
                $fecha = DateTime::createFromFormat('Y-m-d', $fechaNac);
                if (!$fecha) {
                    $error['fechaNac'] = 'El formato de la fecha de nacimiento no es correcto';
                }
            }
        }

        // Validación del DNI
        // Reglas: obligatorio, formato DNI y clave secundaria
        if (strcmp($dni, $alumno->dni) != 0) {
            $cambios = true;
            // Expresión regular para validar el DNI
            // 8 números seguidos de una letra
            $options = [
                'options' => [
                    'regexp' => '/^(\d{8})([A-Za-z])$/'
                ]
            ];

            if (empty($dni)) {
                $error['dni'] = 'El DNI es obligatorio';
            } else if (!filter_var($dni, FILTER_VALIDATE_REGEXP, $options)) {
                $error['dni'] = 'Formato DNI no es correcto';
            } else if (!$this->model->validateUniqueDNI($dni)) {
                $error['dni'] = 'El DNI ya existe';
            }
        }

        // Validación del email
        // Reglas: obligatorio, formato email y clave secundaria
        if (strcmp($email, $alumno->email) != 0) {
            $cambios = true;
            if (empty($email)) {
                $error['email'] = 'El email es obligatorio';
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error['email'] = 'El formato del email no es correcto';
            } else if (!$this->model->validateUniqueEmail($email)) {
                $error['email'] = 'El email ya existe';
            }
        }

        // Validación del teléfono
        // Reglas: obligatorio, formato teléfono
        if (strcmp($telefono, $alumno->telefono) != 0) {
            $cambios = true;
            if (empty($telefono)) {
                $error['telefono'] = 'El teléfono es obligatorio';
            } else if (!preg_match('/^\d{9}$/', $telefono)) {
                $error['telefono'] = 'El formato del teléfono no es correcto';
            }
        }

        // Validación de la nacionalidad
        // Reglas: No obligatorio

        // Validación id_curso
        // Reglas: obligatorio, entero, clave ajena
        if ($id_curso = ! $alumno->id_curso) {
            $cambios = true;
            if (empty($id_curso)) {
                $error['id_curso'] = 'El curso es obligatorio';
            } else if (!filter_var($id_curso, FILTER_VALIDATE_INT)) {
                $error['id_curso'] = 'El formato del curso no es correcto';
            } else if (!$this->model->validateForeignKeyCurso($id_curso)) {
                $error['id_curso'] = 'El curso no existe';
            }
        }

        // Si hay errores
        if (!empty($error)) {

            // Formulario no ha sido validado
            // Tengo que redireccionar al formulario de nuevo

            // Creo la variable de sessión alumno con los datos del formulario
            $_SESSION['alumno'] = $alumno_form;

            // Creo la variable de sessión error con los errores
            $_SESSION['error'] = $error;

            // redireciona al formulario de nuevo
            header('location:' . URL . 'alumno/editar/' . $id . '/' . $csrf_token);
            exit();
        }

        // Compruebo si ha habido cambios
        if (!$cambios) {
            // Genero mensaje de éxito
            $_SESSION['mensaje'] = 'No se han realizado cambios';

            // redireciona al main de alumno
            header('location:' . URL . 'alumno');
            exit();
        }
        // Necesito crear el método update en el modelo
        $this->model->update($alumno_form, $id);

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = 'Alumno actualizado con éxito';

        # Cargo el controlador principal de alumno
        header('location:' . URL . 'alumno');
        exit();
    }

    /*
        Método eliminar()

        Borra un alumno de la base de datos

        url asociada: /alumno/eliminar/id

        @param
            :int $id: id del alumno a eliminar
    */
    public function eliminar($param = [])
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
        else if (!in_array($_SESSION['role_id'], $GLOBALS['alumno']['eliminar'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'alumno');
            exit();
        }

        // obtengo el id del alumno que voy a eliminar
        $id = htmlspecialchars($param[0]);

        // obtengo el token CSRF
        $csrf_token = $param[1];

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }

        // Validar id del alumno
        // validateIdAlumno($id) si existe devuelve TRUE
        if (!$this->model->validateIdAlumno($id)) {
            // Genero mensaje de error
            $_SESSION['error'] = 'ID no válido';

            // redireciona al main de alumno
            header('location:' . URL . 'alumno');
            exit();
        }

        // Id ha sido validado
        // Elimino al alumno de la base de datos
        $this->model->delete($id);

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = 'Alumno eliminado con éxito';

        # Cargo el controlador principal de alumno
        header('location:' . URL . 'alumno');
    }

    /*
        Método mostrar()

        Muestra los detalles de un alumno

        url asociada: /alumno/mostrar/id

        @param
            :int $id: id del alumno a mostrar
    */
    public function mostrar($param = [])
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
        else if (!in_array($_SESSION['role_id'], $GLOBALS['alumno']['mostrar'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'alumno');
            exit();
        }

        // obtengo el id del alumno que voy a eliminar
        $id = htmlspecialchars($param[0]);

        // obtengo el token CSRF
        $csrf_token = $param[1];

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Petición no válida');
            exit();
        }

        // Validar id del alumno
        // validateIdAlumno($id) si existe devuelve TRUE
        if (!$this->model->validateIdAlumno($id)) {
            // Genero mensaje de error
            $_SESSION['error'] = 'ID no válido';

            // redireciona al main de alumno
            header('location:' . URL . 'alumno');
            exit();
        }

        # Cargo el título
        $this->view->title = "Mostrar - Gestión de Alumnos";

        # Obtengo los detalles del alumno mediante el método read del modelo
        $this->view->alumno = $this->model->read($id);

        # obtener los cursos
        $this->view->cursos = $this->model->get_cursos();

        # Cargo la vista
        $this->view->render('alumno/mostrar/index');
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
}
