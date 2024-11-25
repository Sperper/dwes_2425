<?php

/*
    clase: class.tabla_jugadores.php
    descripcion: define la clase que va a contener el array de objetos de la clase jugadores.
*/

class Class_tabla_jugadores
{
    public $tabla;

    public function __construct()
    {
        $this->tabla = [];
    }

    /*
        Nombre: create()
        Descripcion: Permite añadir un objeto de la clase jugador al array
        Parametros de entrada: objeto de la clase jugador

    */
    public function create(Class_jugador $jugador)
    {
        $this->tabla[] = $jugador;
    }

    /*
    Nombre: read()
    Descripcion: Devuelve el objeto de la clase jugador asociado a un índice del array
    Parámetros de entrada: índice del array
    */
    public function read($indice)
    {

        return $this->tabla[$indice];
    }

    /*
    Nombre: getEquipos()
    Descripcion: devuelve un array adjunto con todos los equipos de primera división
    */
    public function getEquipos()
    {
        $equipos = [
            'Boca Juniors',
            'River Plate',
            'San Lorenzo',
            'Vélez Sarsfield',
            'Independiente',
            'Racing Club',
            'Atlético Tucumán',
            'Talleres',
            'Newell\'s Old Boys',
            'Lanús',
            'Huracán',
            'Godoy Cruz',
            'Estudiantes de La Plata',
            'Defensa y Justicia',
            'Argentinos Juniors',
            'Rosario Central'
        ];

        sort($equipos);
        return $equipos;
    }

    /*
    Nombre: getPosiciones
    Descripcion: devuelve un array con los nombres de las distintas posiciones que un jugador puede 
    ocupar en el terreno de juego: portero, lateral, central, medio centro, 
    centrocampista, extremo y delantero.
    */
    public function getPosiciones()
    {
        $posiciones = [
            'Portero',
            'Defensa Central',
            'Lateral Derecho',
            'Lateral Izquierdo',
            'Centrocampista Defensivo',
            'Centrocampista Ofensivo',
            'Extremo Derecho',
            'Extremo Izquierdo',
            'Delantero Centro',
            'Segundo Delantero'
        ];

        sort($posiciones);
        return $posiciones;
    }


    public function getDatos()
    {

        $jugador = new Class_jugador(
            1,
            'Carlos Tévez',
            '1984-02-05',
            1.73,
            75,
            'Argentina',
            10,
            20000000,
            1,
            [9, 10]
        );
        $this->tabla[] = $jugador;

        $jugador = new Class_jugador(
            2,
            'Juan Fernando Quintero',
            '1993-01-18',
            1.65,
            64,
            'Colombia',
            10,
            10000000,
            2,
            [6, 7]
        );
        $this->tabla[] = $jugador;

        $jugador = new Class_jugador(
            3,
            'Ángel Romero',
            '1992-07-04',
            1.74,
            72,
            'Paraguay',
            11,
            8000000,
            3,
            [7,8]
        );
        $this->tabla[] = $jugador;

        $jugador = new Class_jugador(
            4,
            'Luis Abram',
            '1996-05-24',
            1.85,
            77,
            'Perú',
            6,
            6000000,
            4,
            [2, 4]
        );
        $this->tabla[] = $jugador;

        $jugador = new Class_jugador(
            5,
            'Nicolás Domingo',
            '1987-04-25',
            1.73,
            72,
            'Argentina',
            5,
            4000000,
            5,
            [4, 5]
        );
        $this->tabla[] = $jugador;

        return $this->tabla;
    }

    public function mostrar_nombre_posiciones($indices_posiciones = []) {

        $nombre_posiciones = $this->getPosiciones();

        $posiciones_jugador = [];

        foreach ($indices_posiciones as $indice) {
            $posiciones_jugador = $nombre_posiciones[$indice];
        };

        asort($posiciones_jugador);
        return $posiciones_jugador;

    }

}


