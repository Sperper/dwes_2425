<?php

    /*
        Definimos los privilegios de la aplicación

        Recordamos los perfiles:
        - 1: Administrador
        - 2: Editor
        - 3: Registrado

        Recordamos los controladores o recursos:
        - 1: Alumno

        Los privilegios son:
        - 1: main
        - 2: nuevo
        - 3: editar
        - 4: eliminar
        - 5: mostarar
        - 6: ordenar
        - 7: filtrar

        Los perfiles se asignarán mediante un array asociativo, 
        donde la clave principal se corresponde con el controlador 
        la clave secundaria con el  método.

        $GLOBALS['alumno']['main] = [1, 2, 3];

        Se asignan los perfiles que tienen acceso a un determinado método del controlador alumno.

    */ 
    $GLOBALS['alumno']['main'] = [1, 2, 3];
    $GLOBALS['alumno']['nuevo'] = [1, 2];
    $GLOBALS['alumno']['editar'] = [1, 2];
    $GLOBALS['alumno']['eliminar'] = [1];
    $GLOBALS['alumno']['mostrar'] = [1, 2, 3];
    $GLOBALS['alumno']['filtrar'] = [1, 2, 3];
    $GLOBALS['alumno']['ordenar'] = [1, 2, 3];