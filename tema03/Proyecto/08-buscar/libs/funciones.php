<?php

# Busca en la tabla
function buscar_en_tabla($tabla = [], $columna, $valor)
{
    $columna_valores = array_column($tabla, $columna);
    return array_search($valor, $columna_valores, false);

}

# Genera la tabla de libros
function generar_tabla()
{
    $tabla = [
        [
            'id' => 1,
            'titulo' => 'Los señores del tiempo',
            'autor' => 'García Sénz de Urturi',
            'genero'=> 'Novela',
            'precio'=> 19.5,
        ],
        [
            'id' => 2,
            'titulo' => 'El Rey recibe',
            'autor' => 'Eduardo Mendoza',
            'genero'=> 'Novela',
            'precio'=> 20.5,
        ],
        [
            'id' => 3,
            'titulo' => 'Diario de una mujer',
            'autor' => 'Eduardo Mendoza',
            'genero'=> 'Juvenil',
            'precio'=> 12.95,
        ],
        [
            'id' => 4,
            'titulo' => 'El Quijote de la Mancha',
            'autor' => 'Miguel de Cervantes',
            'genero'=> 'Novela',
            'precio'=> 15.5,
        ]
    ];
    return $tabla;

}


















/*

    funcion: eliminar()
    descripción: elimina un elemento de la tabla
    paramteros: 
                - tabla
                - id del elemento que deseo eliminar
    salida: 
                - tabla actualizada

*/

// function eliminar($tabla = [], $id)
// {

//     // Buscar elemento que le corresponde id
//     $lista_id = array_column($tabla, 'id');

//     // Busco id del libro que deseo eliminar en dicha columna
//     $elemento = array_search($id, $lista_id, false);


//     unset($tabla[$elemento]);

//     return $tabla;
//     // Eliminar elemento de la tabla



// }

?>