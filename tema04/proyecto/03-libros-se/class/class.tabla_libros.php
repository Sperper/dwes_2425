<?php

/*
    clase: class.tabla_libros.php
    descripcion: define la clase que va a contener el array de objetos de la clase artículos.
*/

class Class_tabla_libros
{

    public $tabla;

    public function __construct()
    {
        $this->tabla = [];
    }


    public function getMaterias()
    {
        $materias = [
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
            "Otros"
        ];

        asort($materias);
        return $materias;
    }
    public function getEtiquetas()
    {
        $etiquetas = [
            "Antropología",
            "Sociología",
            "Psicología",
            "Economía",
            "Ciencia Política",
            "Derecho",
            "Educación",
            "Geografía",
            "Historia",
            "Ingeniería Civil",
            "Ingeniería Eléctrica",
            "Ingeniería Mecánica",
            "Ingeniería de Sistemas y Computación",
            "Robótica",
            "Inteligencia Artificial",
            "Telecomunicaciones",
            "Filosofía",
            "Teología",
            "Literatura",
            "Lingüística",
            "Historia del Arte",
            "Música",
            "Cine y Medios Audiovisuales",
            "Idiomas y Filología"
        ];

        asort($etiquetas);

        return $etiquetas;
    }

    /*
        método: getDatos()
        descripcion: devuelve un array de objetos
    */

    public function getDatos()
    {

         # Libro 1
    $libro = new Class_libro(
        1,
        'Introducción a la Psicología',
        'John Smith',
        'Editorial McGraw-Hill',
        '2020-09-15',
        2,  // Ciencia Social
        [3, 7, 6],  // Psicología (índice 3), Educación (índice 7), Derecho (índice 6)
        29.99
    );

    # Añado el objeto a la tabla
    $this->tabla[] = $libro;

    # Libro 2
    $libro = new Class_libro(
        2,
        'Historia de la Filosofía',
        'María García',
        'Editorial Planeta',
        '2018-11-03',
        7,  // Humanidades
        [17, 9, 18],  // Filosofía (índice 17), Historia (índice 9), Teología (índice 18)
        39.95
    );

    # Añado el objeto a la tabla
    $this->tabla[] = $libro;

    # Libro 3
    $libro = new Class_libro(
        3,
        'Fundamentos de la Economía',
        'Luis Pérez',
        'Editorial Pearson',
        '2019-03-20',
        2,  // Ciencias Sociales
        [4, 5],  // Economía (índice 4), Ciencia Política (índice 5)
        25.50
    );

    # Añado el objeto a la tabla
    $this->tabla[] = $libro;

    # Libro 4
    $libro = new Class_libro(
        4,
        'Robótica para Principiantes',
        'Andrés Torres',
        'Editorial Alfaomega',
        '2021-06-10',
        5,  // Ingeniería
        [13, 14],  // Ingeniería de Sistemas y Computación (índice 13), Robótica (índice 14)
        45.00
    );

    # Añado el objeto a la tabla
    $this->tabla[] = $libro;

    # Libro 5
    $libro = new Class_libro(
        5,
        'Matemáticas Avanzadas',
        'Carlos López',
        'Editorial Sigma',
        '2017-08-01',
        3,  // Matemáticas
        [9, 5],  // Ingeniería (índice 9), Ciencia Política (índice 5)
        50.75
    );

    # Añado el objeto a la tabla
    $this->tabla[] = $libro;
    }

    /*
        método: mostrar_nombre_categorias()
        descripción: devuelve un array con el nombre de las categorías
        parámetros:
            - indice_categorias
    */

    public function mostrar_nombre_etiquetas($indice_etiquetas = [])
    {
        # creo array de nombre de categorías vacío
        $nombre_etiquetas = [];

        # cargo el array de etiquetas del libro
        $etiquetas_libros = $this->getEtiquetas();

        foreach ($indice_etiquetas as $indice) {
            $nombre_etiquetas[] = $etiquetas_libros[$indice];
        }

        # Ordeno
        asort($nombre_etiquetas);
        return $nombre_etiquetas;
    }

    /*
        método: create()
        descripcion: permite añadir un objeto de la clase artículo a la tabla
        parámetros:

            - $libro - objeto de la clase libro

    */
    public function create(Class_libro $libro)
    {
        $this->tabla[] = $libro;
    }

    /*
        método: read()
        descripcion: permite obtener el objeto de la clase libro a partir de un índice 
        de la tabla

        parámetros:

            - $indice - índice de la tabla
    */
    public function read($indice)
    {
        return $this->tabla[$indice];
    }

    /*
        método: update()
        descripcion: permite actualizar los detalles de un libro en la tabla

        parámetros:

            - $libro - objeto de la clase libro, con los detalles actualizados de dicho artículo
            - $indice - índice de la tabla
    */
    public function update(Class_libro $libro, $indice)
    {
        $this->tabla[$indice] = $libro;
    }


    /*
        método: delete()
        descripcion: permite eliminar un libro de la tabla

        parámetros:

            - $indice - índice de la tabla en la que se encuentra el libro
    */
    public function delete($indice)
    {
        unset($this->tabla[$indice]);
    }
}
