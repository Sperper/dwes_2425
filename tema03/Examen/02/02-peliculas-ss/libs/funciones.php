<?php


    /*
        Genera una tabla

            - Salida. Devuelve array con la tabla generada
    */

    function generar_tabla() {

        $tabla = 

        [
            
            [ 
              "id" => 1,
              "titulo" => "Joker",
              "pais" => 'Estados Unidos',
              "director" => "Todd Phillips",
              "genero" => 'Terror',
              "año" => 2019
              
            ],
            [ 
              "id" => 2,
              "titulo" => "Mientras dure la guerra",
              "pais" => 'España',
              "director" => "Alejandro Amenábar",
              "genero" => 'Histórica',
              "año" => 2019
            ],
            [ 
              "id" => 3,
              "titulo" => "Terminator.Destino oscuro",
              "pais" => 'Estados Unidos',
              "director" => "Tim Miller",
              "genero" => 'Acción',
              "año" => 2019
             
            ],
            [ 
              "id" => 4,
              "titulo" => "La vida es bella",
              "pais" => 'Italia',
              "director" => "Roberto Benini",
              "genero" => 'Comedia',
              "año" => 1997
              
            ],
            [ 
                "id" => 5,
                "titulo" => "Interstellar",
                "pais" => 'Estados Unidos',
                "director" => "Christopher Nolan",
                "genero" => 'Ciencia Ficción',
                "año" => 2014
            ],
            [
                "id" => 6,
                "titulo" => "La La Land",
                "pais" => 'Estados Unidos',
                "director" => "Damien Chazelle",
                "genero" => 'Romance',
                "año" => 2016
            ],
            [
                "id" => 7,
                "titulo" => "El laberinto del fauno",
                "pais" => 'España',
                "director" => "Guillermo del Toro",
                "genero" => 'Drama',
                "año" => 2006
            ]
        ];
        return $tabla; 

    }

