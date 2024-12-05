<?php

/*
    Clase conexión mediante mysqli
*/

class Class_conexion
{

    public $db;

    public function __construct(
        
    ) {
        try {

            // realizo la conexión
            $this->db = new mysqli(SERVER, USER, PASS, BD);

        } catch (mysqli_sql_exception $e) {
            // error de  base dedatos
            include 'views/partials/errorDB.php';

            // cierro conexión
            $this->db->close();

            // cancelo ejecución programa
            exit();

        }

    }

}