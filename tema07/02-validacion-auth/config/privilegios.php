<?php
/*
    Defino los privilegios de la aplicación

    Recordamos los perfiles
    - 1: Administrados
    - 2: Editor
    - 3: Registrado

    Recordemos los controladores o recursos
    - 1: Alumno

    Los privilegos son;
    - 1: main
    - 2: nuevo
    - 3: editar
    - 4: eliminar
    - 5: mostrar
    - 6: ordenar
    - 7: filtrar
    
    Los partials se asignarán mediante un array asociativo 
    donde la clave principal se coresponde con el controlador,
    la clave secundaria con el método.

    Se asingan los perfiles que tienen acceso a un determinado método del controlador alumno.

    
*/

$GLOBALS['alumno']["main"] = [1,2,3];
$GLOBALS['alumno']['nuevo'] = [1,2];
$GLOBALS['alumno']['editar'] = [1,2];
$GLOBALS['alumno']['eliminar'] = [1];
$GLOBALS['alumno']['mostrar'] = [1,2,3];
$GLOBALS['alumno']['filtrar'] = [1,2,3];
$GLOBALS['alumno']['ordenar'] = [1,2,3];