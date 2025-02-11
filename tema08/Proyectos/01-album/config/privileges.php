<?php

    /*
        Definimos los privilegios de la aplicación

        Recordamos los perfiles:
        - 1: Administrador
        - 2: Editor
        - 3: Registrado

        Recordamos los controladores o recursos:
        - 1: album

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

        $GLOBALS['album']['main] = [1, 2, 3];

        Se asignan los perfiles que tienen acceso a un determinado método del controlador album.

    */ 
    $GLOBALS['album']['main'] = [1, 2, 3];
    $GLOBALS['album']['nuevo'] = [1, 2];
    $GLOBALS['album']['editar'] = [1, 2];
    $GLOBALS['album']['eliminar'] = [1];
    $GLOBALS['album']['mostrar'] = [1, 2, 3];
    $GLOBALS['album']['filtrar'] = [1, 2, 3];
    $GLOBALS['album']['ordenar'] = [1, 2, 3];