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

        // Validación del email
        // Reglas: obligatorio, formato email
        if (empty($email)) {
            $error['email'] = 'El email es obligatorio';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = 'El email no es válido';
        } elseif (!$this->model->validateUniqueEmail($email)) {
            $error['email'] = 'El email ya existe';
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

    /*
        Método update()

        Actualiza los detalles de un autor

        url asociada: /autor/update/id

        POST: detalles del autor

        @param int $id: id del autor a editar
    */
    public function update($param = [])
    {
        session_start();

        // Validar token
        $this->checkTokenCsrf($_POST['csrf_token']);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Cargo id del autor
        $id = htmlspecialchars($param[0]);

        // Recogemos los detalles del formulario
        $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_SPECIAL_CHARS);
        $nacionalidad = filter_var($_POST['nacionalidad'], FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS);
        $fecha_nac = filter_var($_POST['fecha_nacimiento'], FILTER_SANITIZE_SPECIAL_CHARS);
        $fecha_def = filter_var($_POST['fecha_defuncion'], FILTER_SANITIZE_SPECIAL_CHARS);
        $premios = filter_var($_POST['premios'], FILTER_SANITIZE_SPECIAL_CHARS);
        
           

        // Con los detalles del formulario creo objeto autor
        $autor_form = new classAutor(
            null,
            $nombre,
            $nacionalidad,
            $email,
            $fecha_nac,
            $fecha_def,
            $premios
        );

        // Validación de datos
        $error = [];
        $cambios = false;

        // Validación del nombre
        if (empty($nombre)) {
            $error['nombre'] = 'El nombre es obligatorio';
        } elseif ($nombre != $this->model->read($id)->nombre) {
            $cambios = true;
        }

        // Validación de la nacionalidad
        if (empty($nacionalidad)) {
            $error['nacionalidad'] = 'La nacionalidad es obligatoria';
        } elseif ($nacionalidad != $this->model->read($id)->nacionalidad) {
            $cambios = true;
        }

        // Validación del email
        if (empty($email)) {
            $error['email'] = 'El email es obligatorio';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = 'El email no es válido';
        } elseif ($email != $this->model->read($id)->email) {
            $cambios = true;
            if (!$this->model->validateUniqueEmail($email)) {
                $error['email'] = 'El email ya existe';
            }
        } 

        // Validación de la fecha de nacimiento
        if (empty($fecha_nac)) {
            $error['fecha_nac'] = 'La fecha de nacimiento es obligatoria';
        } elseif ($fecha_nac != $this->model->read($id)->fecha_nac) {
            $cambios = true;
        }

        // Validación de la fecha de defunción
        if (!empty($fecha_def) && !strtotime($fecha_def)) {
            $error['fecha_def'] = 'La fecha de defunción no es válida';
        } elseif ($fecha_def != $this->model->read($id)->fecha_def) {
            $cambios = true;
        }

        // Validación de los premios
        if (!empty($premios) && strlen($premios) > 255) {
            $error['premios'] = 'Los premios no pueden exceder los 255 caracteres';
        } elseif ($premios != $this->model->read($id)->premios) {
            $cambios = true;
        }

        // Si hay errores
        if (!empty($error)) {
            // Formulario no ha sido validado
            $_SESSION['autor'] = $autor_form;
            $_SESSION['error'] = $error;
            header('location:' . URL . 'autor/editar/' . $id . '/' . $_POST['csrf_token']);
            exit();
        }

        // Compruebo si ha habido cambios
        if (!$cambios) {
            $_SESSION['mensaje'] = 'No se han realizado cambios';
            header('location:' . URL . 'autor');
            exit();
        }

        // Actualizo base de datos
        $this->model->update($autor_form, $id);

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = 'Autor actualizado con éxito';

        // Cargo el controlador principal de autor
        header('location:' . URL . 'autor');
        exit();
    }

    /*
        Método eliminar()

        Borra un autor de la base de datos

        url asociada: /autor/eliminar/id

        @param int $id: id del autor a eliminar
    */
    public function eliminar($param = [])
    {
        session_start();

        // Validar token
        $this->checkTokenCsrf($param[1]);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['autor']['eliminar']);

        // Obtengo el ID y el token CSRF
        $id = htmlspecialchars($param[0]);

        // Validar ID del autor
        if (!$this->model->validateIdAutor($id)) {
            $_SESSION['error'] = 'ID no válido';
            header('location:' . URL . 'autor');
            exit();
        }

        // Eliminar el autor
        $this->model->delete($id);

        // Generar mensaje de éxito
        $_SESSION['mensaje'] = 'Autor eliminado con éxito';

        header('location:' . URL . 'autor');
    }

    /*
        Método mostrar()

        Muestra los detalles de un autor

        url asociada: /autor/mostrar/id

        @param int $id: id del autor a mostrar
    */
    public function mostrar($param = [])
    {
        session_start();

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['autor']['mostrar']);

        $this->checkTokenCsrf($param[1]);

        // Cargo id del autor
        $id = htmlspecialchars($param[0]);

        // Validar ID del autor
        if (!$this->model->validateIdAutor($id)) {
            $_SESSION['error'] = 'ID no válido';
            header('location:' . URL . 'autor');
            exit();
        }

        // Cargo el título
        $this->view->title = "Mostrar - Gestión de autores";

        // Obtengo los detalles del autor mediante el método read del modelo
        $this->view->autor = $this->model->read($id);

        // Cargo la vista
        $this->view->render('autor/mostrar/index');
    }

    /*
        Método filtrar()

        Busca un autor en la base de datos

        url asociada: /autor/filtrar/expresion

        GET: 
            - expresion de búsqueda

        DEVUELVE:
            - PDOStatement con los autores que coinciden con la expresión de búsqueda
    */
    public function filtrar()
    {
        session_start();

        // Validar token
        $this->checkTokenCsrf($_GET['csrf_token']);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['autor']['filtrar']);

        // Obtengo la expresión de búsqueda
        $expresion = htmlspecialchars($_GET['expresion']);

        // Cargo el título
        $this->view->title = "Filtrar por: {$expresion} - Gestión de Autores";

        // Obtengo los autores que coinciden con la expresión de búsqueda
        $this->view->autores = $this->model->filter($expresion);

        // Cargo la vista
        $this->view->render('autor/main/index');
    }

    /*
        Método ordenar()

        Ordena los autores de la base de datos

        url asociada: /autor/ordenar/id

        @param int $id: id del campo por el que se ordenarán los autores
    */
    public function ordenar($param = [])
    {
        session_start();

        // Validar token
        $this->checkTokenCsrf($param[1]);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['autor']['ordenar']);

        // Obtener criterio
        $id = (int) htmlspecialchars($param[0]);

        // Criterios de ordenación
        $criterios = [
            1 => 'Id',
            2 => 'Nombre',
            3 => 'Nacionalidad',
            4 => 'Email',
            5 => 'Fecha de nacimiento',
            6 => 'Fecha de defunción',
            7 => 'Premios'
        ];

        // Cargo el título
        $this->view->title = "Ordenar por {$criterios[$id]} - Gestión de autores";

        // Obtengo los autores ordenados por el campo id
        $this->view->autores = $this->model->order($id);

        // Cargo la vista
        $this->view->render('autor/main/index');
    }

    /*
        Método exportar()

        Permite exportar los autores a un archivo CSV

        url asociada: /autor/exportar/csv

        @param string $format: formato de exportación
    */
    public function exportar($param = [])
    {
        session_start();

        // Validar token
        $this->checkTokenCsrf($param[1]);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['autor']['exportar']);

        // Obtener formato
        $formato = $param[0];

        // Obtener autores
        $autores = $this->model->get_csv();

        // Crear archivo CSV
        $file = 'autores.csv';

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
        foreach ($autores as $autor) {
            fputcsv($fichero, $autor, ';');
        }

        // Cerramos el fichero
        fclose($fichero);

        // Cerramos el buffer de salida y enviamos al cliente el archivo csv
        ob_end_flush();
        exit;
    }

    /*
        Método importar()

        Permite importar los autores desde un archivo CSV

        url asociada: /autor/importar/csv

        @param string $format: formato de importación
    */
    public function importar($param = [])
    {
        session_start();

        // Validar token
        $this->checkTokenCsrf($param[1]);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['autor']['importar']);

        // Comrpuebo si hay errores en la validación
        if (isset($_SESSION['mensaje_error'])) {

            // Creo la propiedad mensaje de error
            $this->view->mensaje_error = $_SESSION['mensaje_error'];

            // Elimino la variable de sesión error
            unset($_SESSION['mensaje_error']);
        }

        // Generar propiedad title
        $this->view->title = "Importar Autores desde fichero CSV";

        // Cargar la vista
        $this->view->render('autor/importar/index');
    }

    public function validar($param = [])
    {
        session_start();

        // Validar token
        $this->checkTokenCsrf($_POST['csrf_token']);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['autor']['importar']);

        // Comprobar si se ha subido un archivo
        if (!isset($_FILES['file'])) {
            $_SESSION['mensaje_error'] = 'No se ha subido ningún archivo';
            header('location:' . URL . 'autor/importar/csv/' . $_POST['csrf_token']);
            exit();
        }

        // Comprobar si el archivo se ha subido correctamente
        if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['mensaje_error'] = 'Error al subir el archivo';
            header('location:' . URL . 'autor/importar/csv/' . $_POST['csrf_token']);
            exit();
        }

        // Verificar la extensión del archivo
        $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        if ($extension !== 'csv') {
            $_SESSION['mensaje_error'] = "El archivo debe tener extensión .csv";
            header('location:' . URL . 'autor/importar/csv/' . $_POST['csrf_token']);
            exit;
        }

        // Comprobar si el archivo es válido
        $file = $_FILES['file']['tmp_name'];

        // Abrir el archivo
        $fichero = fopen($file, 'r');

        // Leer el archivo
        $autores = [];

        while (($linea = fgetcsv($fichero, 0, ';')) !== FALSE) {
            $autores[] = $linea;

            // Validar email
            if (!$this->model->validateUniqueEmail($linea[3])) {
                $_SESSION['mensaje_error'] = 'El email ' . $linea[3] . ' ya existe';
                header('location:' . URL . 'autor/importar/csv/' . $_POST['csrf_token']);
                exit();
            }
        }

        // Cerrar el archivo
        fclose($fichero);

        // Importar los autores
        $count = $this->model->import($autores);

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = $count . ' autores importados con éxito';

        // redireciona al main de autor
        header('location:' . URL . 'autor');
        exit();
    }

    /*
        Método pdf()

        Permite exportar los autores a un archivo PDF

        url asociada: /autor/pdf
    */
    public function pdf($param = [])
    {
        session_start();

        // Validar token
        $this->checkTokenCsrf($param[0]);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['autor']['pdf']);

        // Creo objeto pdf_autores
        $pdf = new PDF_Autores('P', 'mm', 'A4');

        // Obtengo los autores
        $autores = $this->model->get_pdf();

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
        // Escribimos los datos de los autores
        foreach ($autores as $autor) {

            if ($pdf->GetY() > 260) {
                $pdf->AddPage();
                $pdf->cabecera();
                $pdf->SetFillColor(205,205,205); 
            }

            $pdf->Cell(10, 8, mb_convert_encoding($autor['id'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', $fondo);
            $pdf->Cell(25, 8, mb_convert_encoding($autor['nombre'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'L', $fondo);
            $pdf->Cell(25, 8, mb_convert_encoding($autor['nacionalidad'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'L', $fondo);
            $pdf->Cell(50, 8, mb_convert_encoding($autor['email'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'L', $fondo);
            $pdf->Cell(25, 8, mb_convert_encoding($autor['fecha_nac'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'R', $fondo);
            $pdf->Cell(25, 8, mb_convert_encoding($autor['fecha_def'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'R', $fondo);
            $pdf->Cell(30, 8, mb_convert_encoding($autor['premios'], 'ISO-8859-1', 'UTF-8'), 1, 1, 'L', $fondo);

            $fondo = !$fondo;
        }

        // Cerramos pdf
        $pdf->Output('I', 'listado_autores.pdf', true);
    }
}
