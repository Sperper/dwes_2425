<?php

/*
    Clase conexión mediante mysqli
*/

class Class_conexion
{

    public $server;
    public $user;
    public $pass;
    public $base_datos;
    public $db;

    public function __construct(
        $server,
        $user,
        $pass,
        $base_datos
    ) {

        try {
            // asigno valor a las propiedades
            $this->server = $server;
            $this->user = $user;
            $this->pass = $pass;
            $this->base_datos = $base_datos;

            // realizo la conexión
            $this->db = new mysqli($server, $user, $pass, $base_datos);

           
        } catch (mysqli_sql_exception $e) {
            // Error de base datos
            echo "ERRO DE BASE DE DATOS ";
            echo "<br>";
            echo "Mensaje:          " . $e->getMessage();
            echo "Codigo:           " . $e->getCode();
            echo "Fichero:           " . $e->getFile();
            echo "Linea:            " . $e->getLine();
            echo "Trace:            " . $e->getTraceAsString() . "<br>";

            // Cierro conexion
            $this->db->close();

            // Cancelo la conexion
            exit;
       }





    }

}