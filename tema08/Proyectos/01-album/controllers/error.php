<?php

    class Errores extends Controller {

        function __construct($mensaje) {

            parent ::__construct();
            $this->view->mensaje = $mensaje;
            $this->view->render('error/index');
        }

      

    }

?>