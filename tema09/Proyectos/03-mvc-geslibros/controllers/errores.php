<?php

    class Errores extends Controller {

        function __construct($mensaje = null) {

            parent ::__construct();
            
        }

        public function render() {
            $this->view->titulo = 'Error';
            $this->view->mensaje = 'Recurso no encontrado';
            $this->view->render('errores/index');
            
        }

      

    }

?>