<?php

    /*
        Librería proyecto 31 CRUD alumnos
    */

    # Obtiene la tabla de alumnos
    function get_tabla_libros () {

        $tabla = [
            [
                'id' => 1,
                'titulo' => 'Los señores del tiempo',
                'editorial'=> 'Anaya',
                'autor' => 'García Sénz de Urturi',
                'genero'=> 'Novela',
                'precio'=> 19.5,
            ],
            [
                'id' => 2,
                'titulo' => 'El Rey recibe',
                'editorial'=> 'Santillana',
                'autor' => 'Eduardo Mendoza',
                'genero'=> 'Novela',
                'precio'=> 20.5,
            ],
            [
                'id' => 3,
                'titulo' => 'Diario de una mujer',
                'editorial' => 'Síntesis',
                'autor' => 'Eduardo Mendoza',
                'genero'=> 'Juvenil',
                'precio'=> 12.95,
            ],
            [
                'id' => 4,
                'titulo' => 'El Quijote de la Mancha',
                'editorial' => 'Neptuno',
                'autor' => 'Miguel de Cervantes',
                'genero'=> 'Novela',
                'precio'=> 15.5,
            ]
    
        ];
        return $tabla;
    }

    function buscar_tabla($tabla, $columna, $valor){
        $columna_id = array_column($tabla, $columna);
        $indice = array_search($valor, $columna_id);
        return $indice;
    }