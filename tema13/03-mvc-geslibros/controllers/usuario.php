<?php

class Usuario extends Controller {
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
        $this->view->title = "Gestión de Usuarios";

        // Creo la propiedad autores para usar en la vista
        $this->view->usuarios = $this->model->get();

        // Cargo la vista asociada a este método
        $this->view->render('usuario/main/index');
    }

    /*
        Método nuevo()

        Muestra el formulario que permite añadir nuevo usuario

        url asociada: /usuario/nuevo
    */
    public function nuevo($param = [])
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
        $this->view->render('usuario/nuevo/index');
    }

    /*
        Método create()

        Permite añadir nuevo usuario al formulario

        url asociada: /usuario/create
        POST: detalles del usuario
    */
    public function create()
    {
        // inicio o continuo la sesión
        session_start();

        // Validación CSRF
        $this->checkTokenCsrf($_POST['csrf_token']);

        

        // Recogemos los detalles del formulario saneados
        // Prevenir ataques XSS
        $name = filter_var($_POST['name'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
        $password = filter_var($_POST['password'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $password_confirm = filter_var($_POST['password_confirm'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);

        // Validación del formulario de registro

        // Creo un array para almacenar los errores
        $error = [];

        // Validación name
        // Reglas: obligatorio, longitud mínima 5 caracteres, 
        // longitud máxima 20 caracteres, clave secundaria
        if (empty($name)) {
            $error['name'] = 'El nombre es obligatorio';
        } else if (strlen($name) < 5) {
            $error['name'] = 'El nombre debe tener al menos 5 caracteres';
        } else if (strlen($name) > 20) {
            $error['name'] = 'El nombre debe tener como máximo 20 caracteres';
        } else if (!$this->model->validateUniqueName($name)) {
            $error['name'] = 'Nombre existente';
        }

        // Validación email
        // Reglas: obligatorio, formato email, clave secundaria
        if (empty($email)) {
            $error['email'] = 'El email es obligatorio';
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = 'El formato del email no es correcto';
        } else if (!$this->model->validateUniqueEmail($email)) {
            $error['email'] = 'El email ya existe';
        }
       
        // Validación password
        // Reglas: obligatorio, longitud mínima 7 caracteres, campos coincidentes
        if (empty($password)) {
            $error['password'] = 'La contraseña es obligatoria';
        } else if (strlen($password) < 7) {
            $error['password'] = 'La contraseña debe tener al menos 7 caracteres';
        } else if (strcmp($password, $password_confirm) !== 0 ) {
            $error['password'] = 'Las contraseñas no coinciden';
        }

        // Si hay errores
        if (!empty($error)) {

            // Formulario no ha sido validado
            // Tengo que redireccionar al formulario de nuevo

            // Creo la variable de sessión name con los datos del formulario
            $_SESSION['name'] = $name;

            // Creo la variable de sessión email con los datos del formulario
            $_SESSION['email'] = $email;

            // Creo la variable de sessión password con los datos del formulario
            $_SESSION['password'] = $password;

            // Creo la variable de sessión error con los errores
            $_SESSION['error'] = $error;

            // redireciona al formulario de nuevo
            header('location:' . URL . 'usuario/nuevo');
            exit();
        }

        // Formulario validado
        // Añadir usuario a la base de datos
        // Obtengo el id asignado al nuevo usuario
        $id = $this->model->create($name, $email, $password);

        // Asigno el perfil de registrado al nuevo usuario
        // 3 es el id del perfil de registrado
        $this->model->assignRole($id, 3);

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = 'Usuario registrado correctamente';

        // Redireciona al formulario de login
        header('location:' . URL . 'usuario');
        exit();
    }

    /*
        Método para actualizar los datos del usuario. 
        Muestra en la vista el formulario con los datos del usuario en modo edición. 

        url: /perfil/editar

        @param $id int : id del usuario

    */
    public function editar($param = [])
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['usuario']['editar']);

        // Validar token
        $this->checkTokenCsrf($param[1]);

        $this->view->id = htmlspecialchars($param[0]);

        // obtener objeto de la clase usuario con el id asociado
        $this->view->usuario = $this->model->read($this->view->id);

       

        // Compruebo si hay errores de validación
        if (isset($_SESSION['error'])) {

            // Creo la propiedad error de la vista
            $this->view->error = $_SESSION['error'];

            // Creo la propiedad usuario de la vista
            $this->view->usuario = $_SESSION['usuario'];

            // Creo la propiedad mensaje de error
            $this->view->mensaje = 'Error en el formulario';

            // Elimino la variable de sesión usuario
            unset($_SESSION['usuario']);

            // Elimino la variable de sesión error
            unset($_SESSION['error']);
        }

        // Creo la propiedad título
        $this->view->title = "Editar Usuario";

        // Cargo la vista asociada a este método
        $this->view->render('usuario/editar/index');
    }

    /*
        Método para actualizar los datos del usuario. 

        url: /usuario/update

        @param $id int : id del usuario

    */
    /*
        Método para actualizar los datos del usuario. 
        Actualiza los datos del usuario name y email. 

        Incluye:
         - validación token crsf.
         - validación de los datos del formulario.
         - prevención ataques csrf.

        url: /perfil/update

    */
    public function update($param = [])
    {
        // inicio o continuo la sesión
        session_start();

        // Validación CSRF
        $this->checkTokenCsrf($_POST['csrf_token']);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Saneamos los detalles del formulario
        $name = filter_var($_POST['name'] ??= null, FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'] ??= null, FILTER_SANITIZE_EMAIL);
        $password = filter_var($_POST['password'] ??= null, FILTER_SANITIZE_SPECIAL_CHARS);
        $password_confirm = filter_var($_POST['password_confirm'] ??= null, FILTER_SANITIZE_SPECIAL_CHARS);

        // Obtengo los detalles del usuario
        $user = $this->model->read($param[0]);

        // validación de los datos del formulario
        $error = [];
        $cambios = false;

        // validación name
        if ($name != $user->name) {
            if (empty($name)) {
                $error['name'] = 'El nombre es obligatorio';
            } else if (strlen($name) < 5) {
                $error['name'] = 'El nombre debe tener al menos 5 caracteres';
            } else if (strlen($name) > 20) {
                $error['name'] = 'El nombre debe tener como máximo 20 caracteres';
            } else if (!$this->model->validateUniqueName($name)) {
                $error['name'] = 'Nombre existente';
            } else {
                $cambios = true;
            }
        }

        // validación email
        if ($email != $user->email) {
            if (empty($email)) {
                $error['email'] = 'El email es obligatorio';
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error['email'] = 'El email no es válido';
            } else if (!$this->model->validateUniqueEmail($email)) {
                $error['email'] = 'Email existente';
            } else {
                $cambios = true;
            }
        }

        // validación password
        if (!empty($password)) {
            if (strlen($password) < 7) {
                $error['password'] = 'La contraseña debe tener al menos 7 caracteres';
            } else if ($password !== $password_confirm) {
                $error['password'] = 'Las contraseñas no coinciden';
            } else {
                $cambios = true;
            }
        }

        // Si hay errores
        if (!empty($error)) {
            // Creo la variable de sesión error
            $_SESSION['error'] = $error;

            // Creo la variable de sesión usuario
            $_SESSION['usuario'] = (object) [
                'id' => $param[0], // Ensure id is set
                'name' => $name,
                'email' => $email,
                'password' => $password
            ];

            // Redirecciono al formulario de edición
            header('location:' . URL . 'usuario/editar/' . $param[0] . '/' . $_SESSION['csrf_token']);
            exit();
        }

        // Actualizo los datos del usuario
        $this->model->update($name, $email, $_SESSION['user_id'], !empty($password) ? password_hash($password, PASSWORD_BCRYPT) : null);

        // Actualizo el posible nuevo nombre del usuario
        $_SESSION['user_name'] = $name;

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = 'Perfil actualizado correctamente';

        // Redirecciono a la vista principal de usuario
        header('location:' . URL . 'usuario');
        exit();
    }
    
    /*
        Método mostrar()

        Muestra los detalles de un usuario específico

        @param $id int : id del usuario
    */
    public function mostrar($param = [])
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Validar token
        $this->checkTokenCsrf($param[1]);

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['usuario']['mostrar']);

        // Obtener los detalles del usuario
        $this->view->usuario = $this->model->read($param[0]);

        // Creo la propiedad título
        $this->view->title = "Detalles del Usuario";

        // Cargo la vista asociada a este método
        $this->view->render('usuario/mostrar/index');
    }

     /*
        delete($id)

        Método para eliminar el usuario. 
        Elimina el usuario de la base de datos. 

        url: /perfil/delete

        @param $id int : id del usuario

    */
    public function eliminar($param = [])
    {
        // inicio o continuo la sesión
        session_start();

        // Recojo el token crsf enviado en la URL
        $csrf_token = htmlspecialchars($param[1]);

        // Validación token CSRF
        $this->checkTokenCsrf($csrf_token);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['usuario']['eliminar']);

        // Elimino el usuario
        $this->model->delete($param[0]);

        // vuelvo a abrir sesión
        session_start();

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = 'Usuario eliminado correctamente';

        // Redirecciono a la vista principal de usuario
        header('location:' . URL . 'usuario');
        exit();
    }

    /*
        Método filtrar()

        Busca un usuario en la base de datos

        url asociada: /usuario/filtrar/expresion

        GET: 
            - expresion de búsqueda

        DEVUELVE:
            - PDOStatement con los usuarios que coinciden con la expresión de búsqueda
    */
    public function filtrar()
    {
        // inicio o continuo la sesión
        session_start();

        // Validar token
        $this->checkTokenCsrf($_GET['csrf_token']);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['usuario']['filtrar']);

        // Obtengo la expresión de búsqueda
        $expresion = htmlspecialchars($_GET['expresion']);

        // Cargo el título
        $this->view->title = "Filtrar por: {$expresion} - Gestión de Usuarios";

        // Obtengo los usuarios que coinciden con la expresión de búsqueda
        $this->view->usuarios = $this->model->filter($expresion);

        // Cargo la vista
        $this->view->render('usuario/main/index');
    }

    /*
        Método ordenar()

        Ordena los usuarios de la base de datos

        url asociada: /usuario/ordenar/id

        @param
            :int $id: id del campo por el que se ordenarán los usuarios
    */
    public function ordenar($param = [])
    {
        // inicio o continuo la sesión
        session_start();

        // Validar token
        $this->checkTokenCsrf($param[1]);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['usuario']['ordenar']);

        // Obtener criterio
        $id = (int) htmlspecialchars($param[0]);

        // Criterios de ordenación
        $criterios = [
            1 => 'Id',
            2 => 'Nombre',
            3 => 'Email',
        ];

        // Cargo el título
        $this->view->title = "Ordenar por {$criterios[$id]} - Gestión de Usuarios";

        // Obtengo los usuarios ordenados por el campo id
        $this->view->usuarios = $this->model->order($id);

        // Cargo la vista
        $this->view->render('usuario/main/index');
    }

    /*
        Método exportar()

        Permite exportar los usuarios a un archivo CSV

        url asociada: /usuario/exportar/csv

        @param
            :string $format: formato de exportación
    */
    public function exportar($param = [])
    {
        // inicio o continuo la sesión
        session_start();

        // Validar token
        $this->checkTokenCsrf($param[1]);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['usuario']['exportar']);

        // Obtener formato
        $formato = $param[0];

        // Obtener usuarios
        $usuarios = $this->model->get_csv();

        // Crear archivo CSV
        $file = 'usuarios.csv';

        // Limpiar buffer antes de enviar headers
        if (ob_get_length()) ob_clean();

        // Enviamos las cabeceras al navegador para empezar a descargar el archivo
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $file);
        header('Pragma: no-cache');
        header('Expires: 0');

        // Abrimos el archivo csv, con permisos de escritura
        $fichero = fopen('php://output', 'w');

        // Escribir BOM UTF-8 para compatibilidad con Excel
        fprintf($fichero, chr(0xEF) . chr(0xBB) . chr(0xBF));

        // Escribimos los datos del fichero csv
        foreach ($usuarios as $usuario) {
            fputcsv($fichero, $usuario, ';');
        }
        // Cerramos el fichero
        fclose($fichero);

        // Cerramos el buffer de salida y enviamos al cliente el archivo csv
        ob_end_flush();
        exit;
    }

    /*
        Método importar()

        Permite importar los usuarios desde un archivo CSV

        url asociada: /usuario/importar/csv

        @param
            :string $format: formato de importación
    */
    public function importar($param = [])
    {
        // inicio o continuo la sesión
        session_start();

        // Validar token
        $this->checkTokenCsrf($param[1]);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['usuario']['importar']);

        // Comrpuebo si hay errores en la validación
        if (isset($_SESSION['mensaje_error'])) {

            // Creo la propiedad mensaje de error
            $this->view->mensaje_error = $_SESSION['mensaje_error'];

            // Elimino la variable de sesión error
            unset($_SESSION['mensaje_error']);
        }

        // Generar propiedad title
        $this->view->title = "Importar Usuarios desde fichero CSV";

        // Cargar la vista
        $this->view->render('usuario/importar/index');
    }

    public function validar($param = [])
    {
        // inicio o continuo la sesión
        session_start();

        // Validar token
        $this->checkTokenCsrf($_POST['csrf_token']);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['usuario']['importar']);

        // Comprobar si se ha subido un archivo
        if (!isset($_FILES['file'])) {
            $_SESSION['mensaje_error'] = 'No se ha subido ningún archivo';
            header('location:' . URL . 'usuario/importar/csv/' . $_POST['csrf_token']);
            exit();
        }

        // Comprobar si el archivo se ha subido correctamente
        if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['mensaje_error'] = 'Error al subir el archivo';
            header('location:' . URL . 'usuario/importar/csv/' . $_POST['csrf_token']);
            exit();
        }

        // Verificar la extensión del archivo
        $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        if ($extension !== 'csv') {
            $_SESSION['mensaje_error'] = "El archivo debe tener extensión .csv";
            header('location:' . URL . 'usuario/importar/csv/' . $_POST['csrf_token']);
            exit;
        }

        // Comprobar si el archivo es válido
        $file = $_FILES['file']['tmp_name'];

        // Abrir el archivo
        $fichero = fopen($file, 'r');

        // Leer el archivo
        $usuarios = [];

        while (($linea = fgetcsv($fichero, 0, ';')) !== FALSE) {
            $usuarios[] = $linea;

            // Validar email
            if (!$this->model->validateUniqueEmail($linea[2])) {
                $_SESSION['mensaje_error'] = 'El email ' . $linea[2] . ' ya existe';
                header('location:' . URL . 'usuario/importar/csv/' . $_POST['csrf_token']);
                exit();
            }

            // Validar rol
            if (!$this->model->validateForeignKeyRole($linea[3])) {
                $_SESSION['mensaje_error'] = 'El rol ' . $linea[3] . ' no existe';
                header('location:' . URL . 'usuario/importar/csv/' . $_POST['csrf_token']);
                exit();
            }
        }

        // Cerrar el archivo
        fclose($fichero);

        // Importar los usuarios
        $count = $this->model->import($usuarios);

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = $count . ' usuarios importados con éxito';

        // redireciona al main de usuario
        header('location:' . URL . 'usuario');
        exit();
    }

    /*
        Método pdf()

        Permite exportar los usuarios a un archivo PDF

        url asociada: /usuario/pdf
    */
    public function pdf($param = [])
    {
        // inicio o continuo la sesión
        session_start();

        // Validar token
        $this->checkTokenCsrf($param[0]);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['usuario']['pdf']);

        // Creo objeto pdf_usuarios
        $pdf = new PDF_Usuarios('P', 'mm', 'A4');

        // Obtengo los usuarios
        $usuarios = $this->model->get_pdf();

        // Imprimir número página actual
        $pdf->AliasNbPages();

        // Añadimos una página
        $pdf->AddPage();

        // Añado el título
        $pdf->titulo();

        // Cabecera del listado
        $pdf->cabecera();

        // Cuerpo listado
        $pdf->SetFont('Courier', '', 8);
        // Fondo pautado para las líneas pares
        $pdf->SetFillColor(205, 205, 205);

        $fondo = false;
        // Escribimos los datos de los usuarios
        foreach ($usuarios as $usuario) {

            if ($pdf->GetY() > 260) {
                $pdf->AddPage();
                $pdf->cabecera();
                $pdf->SetFillColor(205,205,205); 
            }

            $pdf->Cell(10, 8, mb_convert_encoding($usuario['id'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', $fondo);
            $pdf->Cell(50, 8, mb_convert_encoding($usuario['nombre'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'L', $fondo);
            $pdf->Cell(50, 8, mb_convert_encoding($usuario['email'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'L', $fondo);
            $pdf->Cell(50, 8, mb_convert_encoding($usuario['rol'], 'ISO-8859-1', 'UTF-8'), 1, 1, 'L', $fondo);

            $fondo = !$fondo;
        }

        // Cerramos pdf
        $pdf->Output('I', 'listado_usuarios.pdf', true);
    }
}