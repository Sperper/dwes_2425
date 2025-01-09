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

        // Recogemos los detalles del formulario
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $fechaNac = $_POST['fechaNac'];
        $dni = $_POST['dni'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        $nacionalidad = $_POST['nacionalidad'];
        $id_curso = $_POST['id_curso'];

        // Creamos un objeto de la clase alumno
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

        // Añadimos alumno a la tabla
        $this->model->create($alumno);

        // redireciona al main de alumno
        header('location:' . URL . 'alumno');
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

        $id = $param[0];

        # asigno id a una propiedad de la vista
        $this->view->id = $id;

        # title
        $this->view->title = "Formulario Editar - Gestión de Alumnos";

        # obtener objeto de la clase alumno con el id pasado
        // Necesito crear el método read en el modelo
        $this->view->alumno = $this->model->read($id);

        # obtener los cursos
        $this->view->cursos = $this->model->get_cursos();

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

        # Cargo id del alumno
        $id = $param[0];

        // Recogemos los detalles del formulario
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $fechaNac = $_POST['fechaNac'];
        $dni = $_POST['dni'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        $nacionalidad = $_POST['nacionalidad'];
        $id_curso = $_POST['id_curso'];

        # Con los detalles formulario creo objeto alumno
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

        # Actualizo base  de datos
        // Necesito crear el método update en el modelo
        $this->model->update($alumno, $id);

        # Cargo el controlador principal de alumno
        header('location:' . URL . 'alumno');
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

        # Cargo id del alumno
        $id = $param[0];

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

        # Obtengo la expresión de búsqueda
        $expresion = $_GET['expresion'];

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

        # Obtengo el id del campo por el que se ordenarán los alumnos
        $id = $param[0];


        # Cargo el título
        $this->view->title = "Ordenar por {$criterios[$id]} - Gestión de Alumnos";

        # Obtengo los alumnos ordenados por el campo id
        $this->view->alumnos = $this->model->order($id);

        # Cargo la vista
        $this->view->render('alumno/main/index');
    }
}
