<?php

class Libro extends Controller
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

        // Compruebo si hay mensajes de éxito
        if (isset($_SESSION['success'])) {

            // Creo la propiedad success de la vista
            $this->view->success = $_SESSION['success'];

            // Elimino la variable de sesión
            unset($_SESSION['success']);
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

        Muestra el formulario que permite añadir nuevo alumno

        url asociada: /alumno/nuevo
    */
    public function nuevo()
    {
        // inicio o continuo la sesión
        session_start();

        // Creo un token para evitar ataques CSRF
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));    

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

        Permite añadir nuevo alumno al formulario

        url asociada: /alumno/create
        POST: detalles del alumno
    */
    public function create()
    {

        // inicio o continuo la sesión
        session_start();

        // Validacion CSRF
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            die('Petición no válida');
        }

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
            implode(',', $id_generos)
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
                'regexp' => '/^\d{1,5}-\d{1,7}-\d{1,6}-\d{1,1}$/'
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
            header('location:' . URL . 'libro/nuevo');

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

        Muestra el formulario que permite editar los detalles de un alumno

        url asociada: /alumno/editar/id

        @param int $id: id del alumno a editar

    */
    function editar($param = [])
    {

        # obtengo el id del alumno que voy a editar
        // alumno/edit/4
        // -- alumno es el nombre del controlador
        // -- edit es el nombre del método
        // -- $param es un array porque puedo pasar varios parámetros a un método

        // inicio o continuo la sesion
        session_start();

        # asigno id a una propiedad de la vista
        $this->view->id = htmlspecialchars($param[0]);

        # obtengo el token CSRF
        $this->view->csrf_token = $param[1];

        # Validacion CSRF
        if (!hash_equals($_SESSION['csrf_token'], $this->view->csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Peticion no válida');
            exit();
        }

        # obtengo el objeto de la clase libro con el id asociado
        $this->view->libro = $this->model->read($this->view->id);

        # Compruebo si hay errores de validación
        if(isset($_SESSION['error'])) {

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

        # title
        $this->view->title = "Formulario Editar - Gestión de Libros";

        # obtener objeto de la clase alumno con el id pasado
        // Necesito crear el método read en el modelo
        $this->view->libro = $this->model->read($id);

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

        Actualiza los detalles de un alumno

        url asociada: /alumno/update/id

        POST: detalles del alumno

        @param int $id: id del alumno a editar
    */
    public function update($param = [])
    {

        # inicio o continuo la sesion
        session_start();

        # obtengo el id del alumno que voy a editar
        $id = htmlspecialchars($param[0]);

        # obtengo el token CSRF
        $csrf_token = $param[1];

        # Validacion CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            require_once 'controllers/error.php';
            $controller = new Errores('Peticion no válida');
            exit();
        }

        // Recogemos los detalles del formulario
        $titulo = filter_var($_POST['titulo'], FILTER_SANITIZE_SPECIAL_CHARS);
        $precio = filter_var($_POST['precio'], FILTER_SANITIZE_NUMBER_FLOAT);
        $stock = filter_var($_POST['stock'], FILTER_SANITIZE_NUMBER_INT);
        $fecha_edicion = filter_var($_POST['fecha_edicion'], FILTER_SANITIZE_SPECIAL_CHARS);
        $isbn = filter_var($_POST['isbn'], FILTER_SANITIZE_SPECIAL_CHARS);
        $id_editorial = filter_var($_POST['id_editorial'], FILTER_SANITIZE_NUMBER_INT);
        $id_autor = filter_var($_POST['id_autor'], FILTER_SANITIZE_NUMBER_INT);
        $id_generos = filter_var($_POST['generos'], FILTER_SANITIZE_NUMBER_INT, FILTER_REQUIRE_ARRAY);

        # Con los detalles formulario creo objeto alumno
        $libro_form = new classLibro(

            $id,
            $titulo,
            $precio,
            $stock,
            $fecha_edicion,
            $isbn,
            $id_autor,
            $id_editorial,
            implode(',', $id_generos)

        );

        # Actualizo base  de datos
        # Obtengo los detalles del libro de la base de datos
        $libro = $this->model->read($libro_form);

        # Validacion de los datos
        # Validacion en caso de que haya sufrido modificaciones en el campo correspondiente
        $error = [];

        # Control de cambios en los campos
        $cambios = false;

        # Validacion del título
        # Reglas: obligatorio
        if(strcmp($titulo, $libro->titulo != 0)) {
            $cambios = true;
            if (empty($titulo)) {
                $error['titulo'] = 'El título es obligatorio';
            }
        }

        # Validacion del precio
        # Reglas: obligatorio, numérico
        if(strcmp($precio, $libro->precio != 0)) {
            $cambios = true;
            if (empty($precio)) {
                $error['precio'] = 'El precio es obligatorio';
            } elseif (!is_numeric($precio)) {
                $error['precio'] = 'El precio debe ser numérico';
            }
        }

        # Validacion del stock
        # Reglas: obligatorio, numérico
        if(strcmp($stock, $libro->stock != 0)) {
            $cambios = true;
            if (empty($stock)) {
                $error['stock'] = 'El stock es obligatorio';
            } elseif (!is_numeric($stock)) {
                $error['stock'] = 'El stock debe ser numérico';
            }
        }

        # Validacion de la fecha de edición
        # Reglas: obligatorio
        if(strcmp($fecha_edicion, $libro->fecha_edicion != 0)) {
            $cambios = true;
            if (empty($fecha_edicion)) {
                $error['fecha_edicion'] = 'La fecha de edición es obligatoria';
            }
        }

        # Validacion del ISBN
        # Reglas: obligatorio, formato ISBN y clave secundaria
        if(strcmp($isbn, $libro->isbn != 0)) {
            $cambios = true;
            // Expresión regular para ISBN
            // Formato: 3-598-21508-8
            $options = [
                'options' => [
                    'regexp' => '/^\d{1,5}-\d{1,7}-\d{1,6}-\d{1,1}$/'
                ]
            ];

            if (empty($isbn)) {
                $error['isbn'] = 'El ISBN es obligatorio';
            } elseif (!filter_var($isbn, FILTER_VALIDATE_REGEXP, $options)) {
                $error['isbn'] = 'El ISBN no es válido';
            }
        }

        # Validacion del id_autor
        # Reglas: obligatorio, entero, clave ajena
        if ($id_autor =! $libro->autor_id) {
            $cambios = true;
            if (empty($id_autor)) {
                $error['id_curso'] = 'El curso es obligatorio';
            } else if (!filter_var($id_autor, FILTER_VALIDATE_INT)) {
                $error['id_curso'] = 'El formato del curso no es correcto';
            } else if (!$this->model->validateForeignKeyCurso($id_autor)) {
                $error['id_curso'] = 'El curso no existe';
            }
        }

        # Validacion del id_editorial
        # Reglas: obligatorio, entero, clave ajena
        if ($id_editorial =! $libro->editorial_id) {
            $cambios = true;
            if (empty($id_editorial)) {
                $error['id_editorial'] = 'La editorial es obligatoria';
            } else if (!filter_var($id_editorial, FILTER_VALIDATE_INT)) {
                $error['id_editorial'] = 'El formato de la editorial no es correcto';
            } else if (!$this->model->validateForeignKeyEditorial($id_editorial)) {
                $error['id_editorial'] = 'La editorial no existe';
            }
        }

        # Validacion del id_generos
        # Reglas: obligatorio, entero, clave ajena, array
        if ($id_generos =! $libro->generos) {
            $cambios = true;
            if (empty($id_generos)) {
                $error['id_generos'] = 'El género es obligatorio';
            } else if (!is_array($id_generos)) {
                $error['id_generos'] = 'El género debe ser un número entero';
            } else {
                foreach ($id_generos as $genero) {
                    if (!is_numeric($genero)) {
                        $error['id_generos'] = 'El género debe ser un número entero';
                    }
                }
            }
        }

        # Si hay errores 
        if (!empty($error)) {

            # Creo la variable de sesión error
            $_SESSION['error'] = $error;

            # Creo la variable de sesión libro
            $_SESSION['libro'] = $libro_form;

            # Redirecciono al formulario de editar
            header('location:' . URL . 'libro/editar/' . $id . '/' . $csrf_token);

            # Salgo del script
            exit;
        }

        # Compruebo si hay cambios
        if ($cambios) {
            # Genero un mensaje de éxito
            $_SESSION['mensaje'] = 'No se han realizado cambios';

            # Redirecciono al main de libro
            header('location:' . URL . 'libro');
            exit();
        }

        # Necesito crear el método update en el modelo
        $this->model->update($libro_form, $id);

        # Genero mensaje de exito
        $_SESSION['mensaje'] = 'Libro actualizado con éxito';

        # Cargo el controlador principal de libro
        header('location' . URL . 'libro');
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

        # Cargo id del alumno
        $id = $param[0];

        # Elimino alumno de la base de datos
        // Necesito crear el método delete en el modelo
        $this->model->delete($id);

        # Cargo el controlador principal de alumno
        header('location:' . URL . 'libro');
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

        # Cargo id del alumno
        $id = $param[0];

        # Cargo el título
        $this->view->title = "Mostrar - Gestión de Alumnos";

        # Obtengo los detalles del alumno mediante el método read del modelo
        $this->view->libro = $this->model->read($id);

        # obtener los cursos
        $this->view->cursos = $this->model->get_cursos();

        # Cargo la vista
        $this->view->render('libro/mostrar/index');
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

        # Obtengo la expresión de búsqueda
        $expresion = $_GET['expresion'];

        # Cargo el título
        $this->view->title = "Filtrar por: {$expresion} - Gestión de Libros";



        # Obtengo los alumnos que coinciden con la expresión de búsqueda
        $this->view->libros = $this->model->filter($expresion);

        # Cargo la vista
        $this->view->render('libro/main/index');
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

        # Obtengo el id del campo por el que se ordenarán los alumnos
        $id = $param[0];


        # Cargo el título
        $this->view->title = "Ordenar por {$criterios[$id]} - Gestión de Alumnos";

        # Obtengo los alumnos ordenados por el campo id
        $this->view->libros = $this->model->order($id);

        # Cargo la vista
        $this->view->render('libro/main/index');
    }
}
