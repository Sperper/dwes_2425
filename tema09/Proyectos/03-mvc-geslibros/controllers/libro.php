<?php

class Libro extends Controller
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

        Se  carga siempre que la url contenga sólo el primer parámetro

        url: /libro
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
        $this->checkPermissions($GLOBALS['libro']['main']);

        // Compruebo si hay mensajes de éxito
        if (isset($_SESSION['success'])) {

            // Creo la propiedad success de la vista
            $this->view->success = $_SESSION['success'];

            // Elimino la variable de sesión
            unset($_SESSION['success']);
        }

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje de error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        } // Comprobar si el usuario tiene permisos

        else if (!in_array($_SESSION['role_id'], $GLOBALS['libro']['main'])) {

            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
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


        // Compruebo validación errónea de formulario
        if (isset($_SESSION['error'])) {

            // Creo la propiedad mensaje_error en la vista
            $this->view->mensaje_error = $_SESSION['error'];

            // Elimino la variable de sesión error
            unset($_SESSION['error']);
        }

        // Creo la propiedad title de la vista
        $this->view->title = "Gestión de Libros";

        // Creo la propiedad libros para usar en la vista
        $this->view->libros = $this->model->get();


        // Cargo la vista asociada a este método
        $this->view->render('libro/main/index');
    }

    /*
        Método nuevo()

        Muestra el formulario que permite añadir nuevo libro

        url asociada: /libro/nuevo
    */
    public function nuevo($param = [])
    {
        // inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['libro']['nuevo']);

        // Validar token
        $this->checkTokenCsrf($param[0]);



        // Creo un objeto vacío de la clase libro
        $this->view->libro = new classLibro();

        // Compruebo si hay errores de validación
        if (isset($_SESSION['error'])) {

            // Creo la propiedad error de la vista
            $this->view->error = $_SESSION['error'];

            // Creo la propiedad libro de la vista
            $this->view->libro = $_SESSION['libro'];

            // Creo la propiedad mensaje de error
            $this->view->mensaje = 'Error en el formulario';

            // Elimino la variable de sesión libro
            unset($_SESSION['libro']);

            // Elimino la variable de sesión error
            unset($_SESSION['errores']);
        }

        // Creo la propiead título
        $this->view->title = "Añadir - Gestión de Libros";

        // Creo la propiedad autores en la vista
        $this->view->autores = $this->model->get_autores();

        // Creo la propiedad editoriales en la vista
        $this->view->editoriales = $this->model->get_editoriales();

        // Creo la propiedad géneros en la vista
        $this->view->generos = $this->model->get_generos();

        // Cargo la vista asociada a este método
        $this->view->render('libro/nuevo/index');
    }

    /*
        Método create()

        Permite añadir nuevo libro al formulario

        url asociada: /libro/create
        POST: detalles del libro
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
        $titulo = filter_var($_POST['titulo'], FILTER_SANITIZE_SPECIAL_CHARS);
        $precio = filter_var($_POST['precio'], FILTER_SANITIZE_NUMBER_FLOAT);
        $stock = filter_var($_POST['stock'], FILTER_SANITIZE_NUMBER_INT);
        $fecha_edicion = filter_var($_POST['fecha_edicion'], FILTER_SANITIZE_SPECIAL_CHARS);
        $isbn = filter_var($_POST['isbn'], FILTER_SANITIZE_SPECIAL_CHARS);
        $id_editorial = filter_var($_POST['id_editorial'], FILTER_SANITIZE_NUMBER_INT);
        $id_autor = filter_var($_POST['id_autor'], FILTER_SANITIZE_NUMBER_INT);
        $id_generos = filter_var($_POST['generos'], FILTER_SANITIZE_NUMBER_INT, FILTER_REQUIRE_ARRAY);


        // Creamos un objeto de la clase libro con los detalles del formulario  
        $libro = new classLibro(

            null,
            $titulo,
            $precio,
            $stock,
            $fecha_edicion,
            $isbn,
            $id_autor,
            $id_editorial,
            implode(',', $id_generos),
        );

        // Validación de los datos

        // Creo un array para almacenar los errores
        $error = [];

        // Validación del título
        // Reglas: obligatorio
        if (empty($titulo)) {
            $error['titulo'] = 'El título es obligatorio';
        }

        // Validación del precio
        // Reglas: obligatorio, numérico
        if (empty($precio)) {
            $error['precio'] = 'El precio es obligatorio';
        } elseif (!is_numeric($precio)) {
            $error['precio'] = 'El precio debe ser numérico';
        }

        // Validación del stock
        // Reglas: obligatorio, numérico
        if (empty($stock)) {
            $error['stock'] = 'El stock es obligatorio';
        } elseif (!is_numeric($stock)) {
            $error['stock'] = 'El stock debe ser numérico';
        }

        // Validación de la fecha de edición
        // Reglas: obligatorio
        if (empty($fecha_edicion)) {
            $error['fecha_edicion'] = 'La fecha de edición es obligatoria';
        }

        // Validación del ISBN
        // Reglas: obligatorio, formato ISBN y clave secundaria

        // Expresión regular para ISBN
        // Formato: 3-598-21508-8
        $options = [
            'options' => [
                'regexp' => '/^\d{13}$/'
            ]
        ];

        if (empty($isbn)) {
            $error['isbn'] = 'El ISBN es obligatorio';
        } elseif (!filter_var($isbn, FILTER_VALIDATE_REGEXP, $options)) {
            $error['isbn'] = 'El ISBN no es válido';
        }

        // Validación del autor
        // Reglas: obligatorio
        if (empty($id_autor)) {
            $error['id_autor'] = 'El autor es obligatorio';
        }

        // Validación de la editorial
        // Reglas: obligatorio
        if (empty($id_editorial)) {
            $error['id_editorial'] = 'La editorial es obligatoria';
        }

        // Validación de los géneros
        // Reglas: obligatorio, entero, clave ajena
        if (empty($id_generos)) {
            $error['id_generos'] = 'El género es obligatorio';
        } elseif (!is_array($id_generos)) {
            $error['id_generos'] = 'El género debe ser un número entero';
        } else {
            foreach ($id_generos as $genero) {
                if (!is_numeric($genero)) {
                    $error['id_generos'] = 'El género debe ser un número entero';
                }
            }
        }

        // Si hay errores
        if (!empty($error)) {

            // Creo la variable de sesión error
            $_SESSION['error'] = $error;

            // Creo la variable de sesión libro
            $_SESSION['libro'] = $libro;

            // Redirecciono al formulario de nuevo
            header('location:' . URL . 'libro/nuevo/' . $_SESSION['csrf_token']);

            // Salgo del script
            exit;
        }

        // Añadimos libro a la tabla
        $this->model->create($libro);

        // Genero un mensaje de éxito
        $_SESSION['mensaje'] = 'Libro añadido con éxito';

        // redireciona al main de libro
        header('location:' . URL . 'libro');
        exit();
    }

    /*
        Método editar()

        Muestra el formulario que permite editar los detalles de un libro

        url asociada: /libro/editar/id

        @param int $id: id del libro a editar

    */
    public function editar($param = [])
    {

        # obtengo el id del libro que voy a editar
        // libro/edit/4
        // -- libro es el nombre del controlador
        // -- edit es el nombre del método
        // -- $param es un array porque puedo pasar varios parámetros a un método

        session_start();

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['libro']['editar']);

        // Validar token
        $this->checkTokenCsrf($param[1]);

        $this->view->id = htmlspecialchars($param[0]);

        # obtener objeto de la clase libro con el id asociado
        $this->view->libro = $this->model->read($this->view->id);

        // Compruebo si hay errores de validación
        if (isset($_SESSION['error'])) {

            // Creo la propiedad error de la vista
            $this->view->error = $_SESSION['error'];

            // Creo la propiedad libro de la vista
            $this->view->libro = $_SESSION['libro'];

            // Creo la propiedad mensaje de error
            $this->view->mensaje = 'Error en el formulario';

            // Elimino la variable de sesión libro
            unset($_SESSION['libro']);

            // Elimino la variable de sesión error
            unset($_SESSION['error']);
        }

        # title
        $this->view->title = "Formulario Editar - Gestión de Libros";

        # obtener objeto de la clase libro con el id pasado
        // Necesito crear el método read en el modelo
        $this->view->libro = $this->model->read($this->view->id);

        // Creo la propiedad autores en la vista
        $this->view->autores = $this->model->get_autores();

        // Creo la propiedad editoriales en la vista
        $this->view->editoriales = $this->model->get_editoriales();

        // Creo la propiedad géneros en la vista
        $this->view->generos = $this->model->get_generos();

        # cargo la vista
        $this->view->render('libro/editar/index');
    }

    /*
        Método update()

        Actualiza los detalles de un libro

        url asociada: /libro/update/id

        POST: detalles del libro

        @param int $id: id del libro a editar
    */
    public function update($param = [])
    {

        session_start();

        // Validar token
        $this->checkTokenCsrf($param[1]);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();



        # Cargo id del libro
        $id = htmlspecialchars($param[0]);

        // Recogemos los detalles del formulario
        $titulo = filter_var($_POST['titulo'], FILTER_SANITIZE_SPECIAL_CHARS);
        $precio = filter_var($_POST['precio'], FILTER_SANITIZE_NUMBER_FLOAT);
        $stock = filter_var($_POST['stock'], FILTER_SANITIZE_NUMBER_INT);
        $fecha_edicion = filter_var($_POST['fecha_edicion'], FILTER_SANITIZE_SPECIAL_CHARS);
        $isbn = filter_var($_POST['isbn'], FILTER_SANITIZE_SPECIAL_CHARS);
        $id_editorial = filter_var($_POST['id_editorial'], FILTER_SANITIZE_NUMBER_INT);
        $id_autor = filter_var($_POST['id_autor'], FILTER_SANITIZE_NUMBER_INT);
        $id_generos = filter_var($_POST['generos'], FILTER_SANITIZE_NUMBER_INT, FILTER_REQUIRE_ARRAY);

        # Con los detalles formulario creo objeto libro
        $libro_form = new classLibro(

            null,
            $titulo,
            $precio,
            $stock,
            $fecha_edicion,
            $isbn,
            $id_autor,
            $id_editorial,
            implode(',', $id_generos)

        );

        // Validacion de datos
        // Valido en caso de que haya sufrido modificaciones en el campo correspondiente
        $error = [];

        // Control de cambiosen los campos
        $cambios = false;

        // Validación del título
        // Reglas: obligatorio
        if (empty($titulo)) {
            $error['titulo'] = 'El título es obligatorio';
        } elseif ($titulo != $this->model->read($id)->titulo) {
            $cambios = true;
        }

        // Validación del precio
        // Reglas: obligatorio, numérico
        if (empty($precio)) {
            $error['precio'] = 'El precio es obligatorio';
        } elseif (!is_numeric($precio)) {
            $error['precio'] = 'El precio debe ser numérico';
        } elseif ($precio != $this->model->read($id)->precio) {
            $cambios = true;
        }

        // Validación del stock
        // Reglas: obligatorio, numérico
        if (empty($stock)) {
            $error['stock'] = 'El stock es obligatorio';
        } elseif (!is_numeric($stock)) {
            $error['stock'] = 'El stock debe ser numérico';
        } elseif ($stock != $this->model->read($id)->stock) {
            $cambios = true;
        }

        // Validación de la fecha de edición
        // Reglas: obligatorio
        if (empty($fecha_edicion)) {
            $error['fecha_edicion'] = 'La fecha de edición es obligatoria';
        } elseif ($fecha_edicion != $this->model->read($id)->fecha_edicion) {
            $cambios = true;
        }

        // Validación del ISBN
        // Reglas: obligatorio, formato ISBN y clave secundaria
        if (strcmp($isbn, $libro_form->isbn) != 0) {
            $cambios = true;
            // Expresión regular para validar el DNI
            // 8 números seguidos de una letra
            $options = [
                'options' => [
                    'regexp' => '/^\d{13}$/'
                ]
            ];

            if (empty($isbn)) {
                $error['isbn'] = 'El ISBN es obligatorio';
            } else if (!filter_var($isbn, FILTER_VALIDATE_REGEXP, $options)) {
                $error['isbn'] = 'Formato ISBN no es correcto';
            }
        }

        // Validación del id_autor
        // Reglas: obligatorio, numérico, clave ajena
        if (empty($id_autor)) {
            $error['id_autor'] = 'El autor es obligatorio';
        } elseif ($id_autor != $this->model->read($id)->id_autor) {
            $cambios = true;
        }

        // Validación del id_editorial
        // Reglas: obligatorio, numérico, clave ajena
        if (empty($id_editorial)) {
            $error['id_editorial'] = 'La editorial es obligatoria';
        } elseif ($id_editorial != $this->model->read($id)->id_editorial) {
            $cambios = true;
        }

        // Validación del id_generos
        // Reglas: obligatorio, numérico, clave ajena
        if (empty($id_generos)) {
            $error['id_generos'] = 'El género es obligatorio';
        } elseif (!is_array($id_generos)) {
            $error['id_generos'] = 'El género debe ser un número entero';
        } else {
            foreach ($id_generos as $genero) {
                if (!is_numeric($genero)) {
                    $error['id_generos'] = 'El género debe ser un número entero';
                }
            }
        }

        // Si hay errores
        if (!empty($error)) {

            // Formulario no ha sido validado
            // Tengo que redireccionar al formulario de nuevo

            // Creo la variable de sessión libro con los datos del formulario
            $_SESSION['libro'] = $libro_form;

            // Creo la variable de sessión error con los errores
            $_SESSION['error'] = $error;

            // redireciona al formulario de nuevo
            header('location:' . URL . 'libro/editar/' . $id);
            exit();
        }

        // Compruebo si ha habido cambios
        if (!$cambios) {
            // Genero mensaje de éxito
            $_SESSION['mensaje'] = 'No se han realizado cambios';

            // redireciona al main de libro
            header('location:' . URL . 'libro');
            exit();
        }

        # Actualizo base  de datos
        // Necesito crear el método update en el modelo
        $this->model->update($libro_form, $id);

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = 'Libro actualizado con éxito';

        # Cargo el controlador principal de libro
        header('location:' . URL . 'libro');
        exit();
    }

    /*
        Método eliminar()

        Borra un libro de la base de datos

        url asociada: /libro/eliminar/id

        @param1
            :int $id: id del libro a eliminar
    */
    public function eliminar($param = [])
    {
        session_start();

        // Validar token
        $this->checkTokenCsrf($param[1]);

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['libro']['eliminar']);

        // Obtengo el ID y el token CSRF
        $id = htmlspecialchars($param[0]);

        // obtengo el tokenn CSRF
        $csrf_token = $param[1];

        // Validar CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores();
            exit();
        }

        // Validar ID del libro
        if (!$this->model->validateIdLibro($id)) {
            $_SESSION['error'] = 'ID no válido';
            header('location:' . URL . 'libro');
            exit();
        }

        // Eliminar el libro
        $this->model->delete($id);

        // Generar mensaje de éxito
        $_SESSION['mensaje'] = 'Libro eliminado con éxito';

        header('location:' . URL . 'libro');
    }

    /*
        Método mostrar()

        Muestra los detalles de un libro

        url asociada: /libro/mostrar/id

        @param
            :int $id: id del libro a mostrar
    */
    public function mostrar($param = [])
    {
        # inicio o continuo la sesión
        session_start();

        // Comprobar si hay un usuario logueado
        $this->checkLogin();

        // Comprobar si el usuario tiene permisos
        $this->checkPermissions($GLOBALS['libro']['mostrar']);

        $this->checkTokenCsrf($param[1]);

        # Cargo id del libro
        $id = htmlspecialchars($param[0]);

        // Comprobar si hay un usuario logueado
        if (!isset($_SESSION['user_id'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado';
            header('location:' . URL . 'auth/login');
            exit();
        }
        // Comprobar si el usuario tiene permisos
        else if (!in_array($_SESSION['role_id'], $GLOBALS['libro']['mostrar'])) {
            // Genero mensaje error
            $_SESSION['mensaje_error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('location:' . URL . 'libro');
            exit();
        }

        // Validar ID del libro
        if (!$this->model->validateIdLibro($id)) {
            $_SESSION['error'] = 'ID no válido';
            header('location:' . URL . 'libro');
            exit();
        }

        # Cargo el título
        $this->view->title = "Mostrar - Gestión de libros";

        # Obtengo los detalles del libro mediante el método read del modelo
        $this->view->libro = $this->model->read($id);

        $this->view->autores = $this->model->get_autores();

        $this->view->editoriales = $this->model->get_editoriales();

        # Cargo la vista
        $this->view->render('libro/mostrar/index');
    }

    /*
        Método filtrar()

        Busca un libro en la base de datos

        url asociada: /libro/filtrar/expresion

        GET: 
            - expresion de búsqueda

        DEVUELVE:
            - PDOStatement con los libros que coinciden con la expresión de búsqueda
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
        $this->checkPermissions($GLOBALS['libro']['filtrar']);

        # Obtengo la expresión de búsqueda
        $expresion = htmlspecialchars($_GET['expresion']);

        // obtengo el token CSRF
        $csrf_token = htmlspecialchars($_GET['csrf_token']);




        # Cargo el título
        $this->view->title = "Filtrar por: {$expresion} - Gestión de Libros";



        # Obtengo los libros que coinciden con la expresión de búsqueda
        $this->view->libros = $this->model->filter($expresion);

        # Cargo la vista
        $this->view->render('libro/main/index');
    }

    /*
        Método ordenar()

        Ordena los libros de la base de datos

        url asociada: /libro/ordenar/id

        @param
            :int $id: id del campo por el que se ordenarán los libros
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
        $this->checkPermissions($GLOBALS['libro']['ordenar']);

        // Obtener criterio
        $id = (int) htmlspecialchars($param[0]);

        // Obtenerr csrf_token
        $csrf_token = $param[1];


        # Criterios de ordenación
        $criterios = [
            1 => 'Id',
            2 => 'Titulo',
            3 => 'Precio',
            4 => 'Stock',
            5 => 'Fecha de edicion',
            6 => 'ISBN',
            7 => 'Autor',
            8 => 'Editorial',
            9 => 'Generos'
        ];


        # Cargo el título
        $this->view->title = "Ordenar por {$criterios[$id]} - Gestión de libros";

        # Obtengo los libros ordenados por el campo id
        $this->view->libros = $this->model->order($id);

        # Cargo la vista
        $this->view->render('libro/main/index');
    }

    /*
        Método exportar()

        Permite exportar los libros a un archivo CSV

        url asociada: /libro/exportar/csv

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
        $this->checkPermissions($GLOBALS['libro']['exportar']);

        // Obtener formato
        // en nuestro caso no haría falta puesto que solo tenemos disponible csv
        $formato = $param[0];

        // Obtener libros
        $libros = $this->model->get_csv();

        // Crear archivo CSV
        $file = 'libros.csv';

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
        foreach ($libros as $libro) {
            fputcsv($fichero, $libro, ';');
        }
        // Cerramos el fichero
        fclose($fichero);

        // Cerramos el buffer de salida y enviamos al cliente el archivo csv
        ob_end_flush();
        exit;
    }

    /*
        Método importar()

        Permite importar los libros desde un archivo CSV

        url asociada: /libro/importar/csv

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
        $this->checkPermissions($GLOBALS['libro']['importar']);

        // Comrpuebo si hay errores en la validación
        if (isset($_SESSION['mensaje_error'])) {

            // Creo la propiedad mensaje de error
            $this->view->mensaje_error = $_SESSION['mensaje_error'];

            // Elimino la variable de sesión error
            unset($_SESSION['mensaje_error']);
        }

        // Generar propiedad title
        $this->view->title = "Importar Libros desde fichero CSV";

        // Cargar la vista
        $this->view->render('libro/importar/index');
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
        $this->checkPermissions($GLOBALS['libro']['importar']);

        // Comprobar si se ha subido un archivo
        if (!isset($_FILES['file'])) {
            $_SESSION['mensaje_error'] = 'No se ha subido ningún archivo';
            header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
            exit();
        }

        // Comprobar si el archivo se ha subido correctamente
        if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['mensaje_error'] = 'Error al subir el archivo';
            header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
            exit();
        }

        // Verificar la extensión del archivo
        $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        if ($extension !== 'csv') {
            $_SESSION['mensaje_error'] = "El archivo debe tener extensión .csv";
            header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
            exit;
        }



        // Comprobar si el archivo es válido
        $file = $_FILES['file']['tmp_name'];

        // Abrir el archivo
        $fichero = fopen($file, 'r');

        // Leer el archivo
        $libros = [];

        while (($linea = fgetcsv($fichero, 0, ';')) !== FALSE) {
            $libros[] = $linea;

            // Validar ISBN
            if (!$this->model->validateUniqueISBN($linea[4])) {
                $_SESSION['mensaje_error'] = 'El ISBN ' . $linea[4] . ' ya existe';
                header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
                exit();
            }

            // Validar id_autor
            if (!$this->model->validateForeignKeyAutor($linea[5])) {
                $_SESSION['mensaje_error'] = 'El autor ' . $linea[5] . ' no existe';
                header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
                exit();
            }

            // Validar id_editorial
            if (!$this->model->validateForeignKeyEditorial($linea[6])) {
                $_SESSION['mensaje_error'] = 'La editorial ' . $linea[6] . ' no existe';
                header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
                exit();
            }

            // Validar generos id
            foreach (explode(',', $linea[7]) as $genero) {
                if (!$this->model->validateGenerosExist($genero)) {
                    $_SESSION['mensaje_error'] = 'El género ' . $genero . ' no existe';
                    header('location:' . URL . 'libro/importar/csv/' . $_POST['csrf_token']);
                    exit();
                }
            }
        }

        // Cerrar el archivo
        fclose($fichero);

        // Importar los libros
        $count = $this->model->import($libros);

        // Genero mensaje de éxito
        $_SESSION['mensaje'] = $count . ' libros importados con éxito';


        // redireciona al main de libro
        header('location:' . URL . 'libro');
        exit();
    }

    /*
        Método pdf()

        Permite exportar los libros a un archivo PDF

        url asociada: /libro/pdf
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
        $this->checkPermissions($GLOBALS['libro']['pdf']);



        // Creo objeto pdf_alumnos
        $pdf = new PDF_Libros('P', 'mm', 'A4');

        // Obtengo los libros
        $libros = $this->model->get_pdf();

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
        // Escribimos los datos de los libros
        foreach ($libros as $libro) {
            $pdf->Cell(10, 10, mb_convert_encoding($libro['id'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', $fondo);
            $pdf->Cell(50, 10, mb_convert_encoding($libro['titulo'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'L', $fondo);
            $pdf->Cell(50, 10, mb_convert_encoding($libro['autor'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'L', $fondo);
            $pdf->Cell(55, 10, mb_convert_encoding($libro['editorial'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'L', $fondo);
            $pdf->Cell(20, 10, mb_convert_encoding($libro['precio'], 'ISO-8859-1', 'UTF-8'), 1, 1, 'R', $fondo);

            $fondo = !$fondo;
        }


        // Cerramos pdf
        $pdf->Output('I', 'listado_libros.pdf', true);
    }
}
