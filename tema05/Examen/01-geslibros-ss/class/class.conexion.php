<?php

/*
    Clase conexión mediante mysqli
*/

class Class_conexion
{

    // objeto de la clase pdo
    public $pdo;

    public function __construct(
        
    ) {
        try {

            // nombre fuente de datos
            $dsn = "mysql:host=" . SERVER . ";dbname=". BD;

            // array de opciones para la clase pdo
            $options = [

                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_PERSISTENT =>  false,
                PDO::ATTR_EMULATE_PREPARES =>  false,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES ".CHARSET. " COLLATE ". COLLECTION

            ];

            // realizo la conexión
            $this->pdo = new PDO($dsn, USER, PASS, $options);

        } catch (PDOException $e) {

            // error de  base dedatos
            include 'views/partials/errorDB.php';

            // cierro conexión
            $this->pdo = null;

            // cancelo ejecución programa
            exit();

        }








    }

}