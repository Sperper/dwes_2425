<?php

/*
    class: class.tabla_profesores.php
    descripcion: defines las clases que van a contener el array de objetos de la clase profesor
*/

class Class_tabla_profesores
{

    public $tabla;

    # Método constructor de la clase
    public function __construct()
    {
        $this->tabla = [];
    }

    # Funcion que devuelve un array de especialidades
    public function getEspecialidad()
    {
        $especialidad = [
            "Literatura Española",
            "Ciencias Sociales",
            "Matemáticas",
            "Ciencias de la Salud",
            "Ingeniería",
            "Tecnología",
            "Humanidades",
            "Artes",
            "Informática",
            "Religión",
            "Inglés",
        ];

        asort($especialidad);
        return $especialidad;
    }

    #Funcion que devuelve un array de asignaturas
    public function getAsignaturas()
    {
        $asignaturas = [
            "Sistemas informáticos",
            "Bases de datos",
            "Programación",
            "Lenguajes de marcas y sistemas de gestión de información",
            "Entornos de desarrollo",
            "Desarrollo web en entorno cliente",
            "Desarrollo web en entorno servidor",
            "Despliegue de aplicaciones web",
            "Diseño de interfaces web",
            "Empresa e iniciativa emprendedora",
            "Formación y orientación laboral (FOL)",
            "Proyecto de desarrollo de aplicaciones web (normalmente al final del ciclo)",
            "Inglés técnico",
        ];

        asort($asignaturas);
        return $asignaturas;
    }

    # Método getDatos
    public function getDatos()
    {
        # Profesor 1
        $profesor = new Class_profesor(
            1,
            'Juan',
            'Pérez García',
            '123456789',
            '15/03/1980',
            'Madrid',
            3,
            [1, 2]
        );

        $this->tabla[] = $profesor;

        # Profesor 2
        $profesor = new Class_profesor(
            2,
            'Laura',
            'Martínez López',
            '987654321',
            '02/07/1992',
            'Barcelona',
            6,
            [6, 7]
        );

        $this->tabla[] = $profesor;

        # Profesor 3
        $profesor = new Class_profesor(
            3,
            'Carlos',
            'Rodríguez Sánchez',
            '112233445',
            '21/10/1985',
            'Sevilla',
            1,
            [4, 5]
        );

        $this->tabla[] = $profesor;

        # Profesor 4
        $profesor = new Class_profesor(
            4,
            'Elena',
            'Gómez Fernández',
            '334455667',
            '10/04/1978',
            'Valencia',
            2,
            [9, 8]
        );

        $this->tabla[] = $profesor;

        # Profesor 5
        $profesor = new Class_profesor(
            5,
            'Antonio',
            'Ruiz Martín',
            '556677889',
            '10/08/1990',
            'Málaga',
            5,
            [11, 12]
        );

        $this->tabla[] = $profesor;

    }

    /*
    método: mostrar_nombre_asignaturas()
    descripción: devuelve el nombre de las asignaturas
    parámetros:
        - indice_asignaturas
*/

    public function mostrar_nombre_asignaturas($indice_asignaturas = [])
    {
        # creo array de nombre de categorías vacío
        $nombre_asignaturas = [];

        # cargo el array de etiquetas del libro
        $asignaturas_maestros = $this->getAsignaturas();

        foreach ($indice_asignaturas as $indice) {
            $nombre_asignaturas[] = $asignaturas_maestros[$indice];
        }

        # Ordeno
        asort($nombre_asignaturas);
        return $nombre_asignaturas;
    }

    /*
        método: create()
        descripcion: permite añadir un objeto de la clase profesor a la tabla
        parámetros:

            - $profesor - objeto de la clase profesor

    */
    public function create(Class_profesor $profesor)
    {
        $this->tabla[] = $profesor;
    }

    /*
        método: read()
        descripcion: permite obtener el objeto de la clase profesor a partir de un índice 
        de la tabla

        parámetros:

            - $indice - índice de la tabla
    */
    public function read($indice)
    {
        return $this->tabla[$indice];
    }

}