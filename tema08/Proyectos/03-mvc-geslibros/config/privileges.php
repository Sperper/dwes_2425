<?php

    /*
        Definimos los privilegios de la aplicación

        Recordamos los perfiles:
        - 1: Administrador
        - 2: Editor
        - 3: Registrado

        Recordamos los controladores o recursos:
        - 1: libro

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

        $GLOBALS['libro']['main] = [1, 2, 3];

        Se asignan los perfiles que tienen acceso a un determinado método del controlador libro.

    */ 
    $GLOBALS['libro']['main'] = [1, 2, 3];
    $GLOBALS['libro']['nuevo'] = [1, 2];
    $GLOBALS['libro']['editar'] = [1, 2];
    $GLOBALS['libro']['eliminar'] = [1];
    $GLOBALS['libro']['mostrar'] = [1, 2, 3];
    $GLOBALS['libro']['filtrar'] = [1, 2, 3];
    $GLOBALS['libro']['ordenar'] = [1, 2, 3];
    $GLOBALS['libro']['exportar'] = [1];
    $GLOBALS['libro']['importar'] = [1];