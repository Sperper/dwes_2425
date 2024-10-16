<?php

    /*
        Libreria proyecto 31 CRUD alumno
    */
    
    # Obttiene la tabla de alumnos
    function get_tabla_alumnos  () {
        $tabla = [
            [
                "id" => 1,
                "nombre" => "Juan",
                'poblacion' => "Ubrique",
                'curso' => '2DAW'
            ],
            [
                "id" => 2,
                "nombre" => "Pedro",
                'poblacion' => "Prado del rey",
                'curso' => '2DAW'
            ],
            [
                "id" => 3,
                "nombre" => "Mario",
                'poblacion' => "Villamartin",
                'curso' => '1DAW'
            ],
            [
                "id" => 4,
                "nombre" => "Adrian",
                'poblacion' => "Ubrique",
                'curso' => '2DAW'
            ]
        ];
        return $tabla;
    }