<?php


/*
    Genera una tabla

        - Salida. Devuelve array con la tabla generada
*/

function generar_tabla()
{

    $tabla = [

        [
            'id' => 1,
            'descripcion' => 'Portátil HP MD12345',
            'modelo' => 'HP 15-1234-20',
            'categoria' => 'Portátiles',
            'unidades' => 12,
            'precio' => 550.50
        ],
        [
            'id' => 2,
            'descripcion' => 'Tablet - Samsung Galaxy Tab A (2019)',
            'modelo' => 'Exynos',
            'categoria' => 'Tablets',
            'unidades' => 200,
            'precio' => 300
        ],
        [
            'id' => 3,
            'descripcion' => 'Impresora multifunción - HP',
            'modelo' => 'DeskJet 3762',
            'categoria' => 'Dispositivo Salida',
            'unidades' => 2000,
            'precio' => 69.99
        ],
        [
            'id' => 4,
            'descripcion' => "TV LED 40' - Thomson 40FE5606 - Full HD ",
            'modelo' => 'Thomson 40FE5606',
            'categoria' => 'Televisión',
            'unidades' => 300,
            'precio' => 259
        ],
        [
            'id' => 5,
            'descripcion' => 'PC Sobremesa - Acer Aspire XC-830',
            'modelo' => 'Acer Aspire XC-830',
            'categoria' => 'PC',
            'unidades' => 20,
            'precio' => 329
        ]
    ];


    return $tabla;
}

/*
    Function: buscar_registro()
*/

function buscar_registro($tabla, $columna, $valor)
{
    $registro = null;

    foreach ($tabla as $key => $articulo) {
        if ($articulo[$columna] == $valor) {
            $registro = $articulo;
        }
    }

    return $registro;

}




/*
Function: nuevo()
descripcion: Añade un nuevo elemento a la tabla
Entrada:
        - tabla (array)
        - nuevo registro de la tabla (array indexado)
Salida:
        - tabla actualizada
*/

function nuevo($tabla, $registro)
{
    $tabla[] = $registro;
    return $tabla;

}



/*
Function: update()
descripcion: Actualiza los datos de un libro
Entrada:
        - tabla (array)
        - registro
        - indice
Salida:
        - tabla actualizada
*/
function update($tabla, $registro, $indice)
{
    $indiceRegistro = buscar_registro($tabla, 'id', $indice);
    $tabla[$indiceRegistro] = $registro;
    return $tabla;
}

