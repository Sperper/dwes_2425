<?php

    /*
        Librería proyecto 31 CRUD alumnos
    */

    # Obtiene la tabla de alumnos
    function get_tabla_alumnos () {

        $tabla = [
            [
                'id' => 1,
                'nombre' => 'Juan',
                'poblacion' => 'Ubrique',
                'curso' => '2DAW'
            ],
            [
                'id' => 2,
                'nombre' => 'María',
                'poblacion' => 'Ubrique',
                'curso' => '2DAW'
            ],
            [
                'id' => 3,
                'nombre' => 'Luís',
                'poblacion' => 'Villamartín',
                'curso' => '1DAW'
            ],
            [
                'id' => 4,
                'nombre' => 'Marta',
                'poblacion' => 'Ubrique',
                'curso' => '2DAW'
            ]
        ];
        return $tabla;
    }

    function buscar_tabla($tabla, $columna, $valor){
        $columna_id = array_column($tabla, $columna);
        $indice = array_search($valor, $columna_id);
        return $indice;
    }

    function buscar_tabla_2($tabla, $columna, $valor) {
        foreach ($tabla as $indice => $registro) {
            if ($registro[$columna] == $valor ) {
                return $indice;
            }
        }
        return false;
    }