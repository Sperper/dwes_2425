<?php
class Perfil extends Controller
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


        # Obtenemos los detalles completos del usuario
        $this->view->perfil = $this->model->getUserId($_SESSION['user_id']);

        // Creo la propiedad title de la vista
        $this->view->title = "Mi perfil " . $_SESSION['user_name'];

        $this->view->render('perfil/main/index');
    }

    /*
        Método para actualizar los datos del usuario
        Muestra en la vista el formulario con los datos del usuario en modo edicion.

        url; /perfil/editar

        @param: id int : id del usuario
    */
    public function edit($id)
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje de error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }

        if (!isset($_SESSION['mensaje_error'])) {

            // Creo la propiedad mensaje en la vista
            $this->view->mensaje_error = $_SESSION['mensaje_error'];

            // Elimino la variable de sesion mensaje
            unset($_SESSION['mensaje_error']);
        }

        // Obtener los datos del usuario
        $this->view->perfil = $this->model->getUserId($id);

        // Capa de no validación del formulario
        if (isset($_SESSION['error'])) {

            // Creo la variable de sesión error
            $this->view->errores = $_SESSION['error'];

            // Elimino la variable de sesión error
            unset($_SESSION['error']);

            // Asigno a oerfil os detalles del formulario
            $this->view->perfil = $_SESSION['perfil'];

            // Elimino la variable de sesion perfil
            unset($_SESSION['perfil']);

            // Creo la propiedad mensaje error
            $this->view->mensaje_error = "Hay errores en el formulario";
        }

        // Creo la propiedad title de la vista
        $this->view->title = "Editar perfil " . $_SESSION['user_name'];

        // Renderizar la vista de edición
        $this->view->render('perfil/editar/index');
    }

    /*
        Método para actualizar los datos del usuario.
        Actualizo los datos del usuario name y email

        Incluye:
        - validación token csrf
        - validación de los datos del formulario
        - preotección ataques csrf

    */
    public function update()
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje de error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }

        // Saneamos los etalles del formulario
        $name = filter_var($_POST['name'] ??= null, FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'] ??= null, FILTER_SANITIZE_EMAIL);


        // Obrengo los detalles del usuario
        $user = $this->model->getUserId($_SESSION['user_id']);



        // Validar token CSRF
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            $_SESSION['mensaje_error'] = 'Token CSRF inválido';
            header('location:' . URL . 'perfil/editar/' . $_SESSION['user_id']);
            exit();
        }

        // Validar datos del formulario
        $errores = [];

        // Validación name
        // Reglas: obligatorio, longitud mínima 5 caracteres, 
        // longitud máxima 20 caracteres, clave secundaria
        if ($name != $user->name) {
            if (empty($name)) {
                $error['name'] = 'El nombre es obligatorio';
            } else if (strlen($name) < 5) {
                $error['name'] = 'El nombre debe tener al menos 5 caracteres';
            } else if (strlen($name) > 20) {
                $error['name'] = 'El nombre debe tener como máximo 20 caracteres';
            } else if (!$this->model->validateUniqueName($name)) {
                $error['name'] = 'Nombre existente';
            }
        }

        // Validación email
        // Reglas: obligatorio, formato email, clave secundaria
        if ($email != $user->email) {
            if (empty($email)) {
            $error['email'] = 'El email es obligatorio';
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = 'El formato del email no es correcto';
            } else if (!$this->model->validateUniqueEmail($email)) {
            $error['email'] = 'El email ya existe';
            }
        }

        // Si hay errores, redirigir al formulario de edición con los errores
        if (!empty($errores)) {
            $_SESSION['error'] = $errores;
            $_SESSION['perfil'] = $_POST;
            header('location:' . URL . 'perfil/editar/' . $_SESSION['user_id']);
            exit();
        }

        // Actualizar los datos del usuario
        $this->model->update($_SESSION['user_id'], $_POST['name'], $_POST['email']);

        // Generar mensaje de éxito
        $_SESSION['mensaje'] = 'Perfil actualizado correctamente';
        header('location:' . URL . 'perfil');
        exit();
    }

    public function pass() {
        
    }
}
