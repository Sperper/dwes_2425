<?php

class Auth extends Controller
{

    function __construct()
    {

        parent::__construct();
    }

    /*
        Método principal

        Carga el formulario de autenticación
        url: /auth

        Detalles:

            - email
            - password   

    */
    public function login()
    {
        // inicio o continuo la sesión
        session_start();

        // Creo un token CSRF
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        // Inicializo los campos del formulario
        $this->view->email = null;
        $this->view->password = null;

        // Compruebo si hay mensaje de éxito
        if (isset($_SESSION['mensaje'])) {

            // Creo la propiedad mensaje en la vista
            $this->view->mensaje = $_SESSION['mensaje'];

            // Elimino la variable de sesión mensaje
            unset($_SESSION['mensaje']);
        }

        // Compruebo mensaje error
        if (isset($_SESSION['error'])) {

            // Creo la propiedad mensaje_error en la vista
            $this->view->mensaje_error = $_SESSION['error'];

            // Elimino la variable de sesión error
            unset($_SESSION['error']);
        }

        // Creo la propiedad title de la vista
        $this->view->title = "Autenticación de Usuarios";

        // Cargo la vista login
        $this->view->render('auth/login/index');
    }

    /*
        Método register()

        Autoregistro de un usuario

            - name
            - email
            - password

        url asociada: /auth/register
    */
    public function register()
    {
        // inicio o continuo la sesión
        session_start();

        // Creo un token CSRF
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        // Inicializo los campos del formulario
        $this->view->name = null;
        $this->view->email = null;
        $this->view->password = null;

        // Comrpuebo si hay errores en la validación
        if (isset($_SESSION['error'])) {

            // Creo la propiedad error en la vista
            $this->view->error = $_SESSION['error'];

            // Retroalimento los campos del  formulario
            $this->view->name = $_SESSION['name'];
            $this->view->email = $_SESSION['email'];
            $this->view->password = $_SESSION['password'];

            // Creo la propiedad mensaje de error
            $this->view->mensaje_error = 'Error en el registro de usuario';

            // Elimino la variable de sesión error
            unset($_SESSION['error']);

            // Elimino la variable de sesión alumno
            unset($_SESSION['name']);
            unset($_SESSION['email']);
            unset($_SESSION['password']);
        }

        // Creo la propiead título
        $this->view->title = "Registro de Usuarios";

        // Cargo la vista Registro de usuarios
        $this->view->render('auth/register/index');
    }

    /*
        Método validete_regiser()

        Permite:
            - Validar nuevo usuario
            - En caso de error de validación. Retroalimenta el formulario y muestra errores
            - En caso de validación. Añade usuario con perfil de registrado

        url asociada: /auth/validate_register()
        
        POST: detalles del nuevo usuario

            - name
            - email
            - password
            - password-confirm
    */
    public function validate_register()
    {

        // inicio o continuo la sesión
        session_start();

        // Validación token CSRF
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            // require_once 'controllers/error.php';
            // $controller = new Errores('Petición no válida');
            // exit();
            header('location:' . URL . 'errores');
            exit();
        }

        // Recogemos los detalles del formulario saneados
        // Prevenir ataques XSS
        $name = filter_var($_POST['name'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
        $password = filter_var($_POST['password'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $password_confirm = filter_var($_POST['password_confirm'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);

        // Validación de formulario de registro


        // Creo un array para almacenar los errores
        $error = [];

        // Validación name
        // Reglas: obligatorio, longitud minimo 5 caracteres, longitud máxima de 20 caracteres y clave secundaria
        if (empty($name)) {
            $error['name'] = 'El nombre es obligatorio';
        } else if (strlen($name) < 5) {
            $error['name'] = 'El nombre debe tener al menos 5 caracteres';
        } else if (strlen($name) > 20) {
            $error['name'] = 'El nombre no puede tener más de 20 caracteres';
        } else if (!$this->model->validateUniqueName($name)) {
            $error['name'] = 'Nombre existente';
        }

        // Validación del email
        // Reglas: obligatorio, formato email y clave secundaria
        if (empty($email)) {
            $error['email'] = 'El email es obligatorio';
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = 'El formato del email no es correcto';
        } else if (!$this->model->validateUniqueEmail($email)){
            $error['email'] = 'El email ya existe';
        }

        // Validación password
        // Reglas: obligatorio, longitud mínima 8 caracteres, debe coincidir con password_confirm
        if (empty($password)) {
            $error['password'] = 'La contraseña es obligatoria';
        } else if (strlen($password) < 8) {
            $error['password'] = 'La contraseña debe tener al menos 8 caracteres';
        } else if (strcmp($password,$password_confirm) !==0) {
            $error['password'] = 'Las contraseñas no coinciden';
        }

        

        // Si hay errores
        if (!empty($error)) {

            // Formulario no ha sido validado
            // Tengo que redireccionar al formulario de nuevo

            // Creo la variable de sesión con los datos del formulario
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;

            // Creo la variable de sesión error con los errores
            $_SESSION['error'] = $error;

            // redirecciona al formulario de nuevo
            header('location:' . URL . 'auth/register');
            exit();
        }

        // Formulario validación
        // Añadir usuarrio a la base de datos
        // Obtengo el id asignado al nuevo usuario
        $id = $this->model->create($name,$email,$password);

        // Asignar el rol de usuario registrado
        $this->model->assignRole($id, 3);

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = 'Usuario registrado con éxito';

        // Redirecciona al formulario de login
        header('location:' . URL . 'auth/register');
        exit();
    }

    /*
        Método validate_login()

        Permite:
            - Validar usuario existente
            - En caso de error de validación. Retroalimenta el formulario y muestra errores
            - En caso de validación. Inicia sesión del usuario

        url asociada: /auth/validate_login()
        
        POST: detalles del usuario

            - email
            - password
    */
    public function validate_login()
    {
        // inicio o continuo la sesión
        session_start();

        // Validación token CSRF
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            header('location:' . URL . 'errores');
            exit();
        }

        // Recogemos los detalles del formulario saneados
        $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
        $password = filter_var($_POST['password'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);

        // Creo un array para almacenar los errores
        $error = [];

        // Validación del email
        if (empty($email)) {
            $error['email'] = 'El email es obligatorio';
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = 'El formato del email no es correcto';
        }

        $user = $this->model->getUserByEmail($email);

        // Si no existe el usuario
        if (!$user) {
            $error['email'] = 'El usuario no existe';
        }

        // Valido password
        // Obligatorio, longitud minima 8 caracteres
        if (empty($password)) {
            $error['password'] = 'La contraseña es obligatoria';
        } else if (strlen($password) < 8) {
            $error['password'] = 'La contraseña debe tener al menos 8 caracteres';
        } else if (!password_verify($password, $user->password)) {
            $error['password'] = 'La contraseña es incorrecta';
        }

        // Si hay errores
        if (!empty($error)) {
            // Formulario no ha sido validado
            // Creo la variable de sesión error con los errores
            $_SESSION['error'] = $error;

            // Creo la variable de sesión con los datos del formulario
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;

            // redirecciona al formulario de nuevo
            header('location:' . URL . 'auth/login');
            exit();
        }

        // Validar usuario en la base de datos
        $user = $this->model->validateUser($email, $password);

        if (!$user) {
            // Usuario no válido
            $_SESSION['error'] = ['login' => 'Email o contraseña incorrectos'];
            header('location:' . URL . 'auth/login');
            exit();
        }

        // Usuario válido
        // Inicio sesión del usuario
        $_SESSION['user_id'] = $user->id;
        $_SESSION['name_user'] = $user->name;
        
        // Datos del rol del usuario
        $_SESSION['role_id'] = $this->model->getPerfilUser($user->id);
        $_SESSION['name_rol'] = $this->model->getNombrePerfil($_SESSION['role_id']);

        // Generar mensaje de inicio de sesion
        $_SESSION['mensaje'] = 'Sesión iniciada con éxito';

        // Redirecciona al área de usuario
        header('location:' . URL . 'alumno');
        exit();
    }
}
