<?php

/*
    Clase conexión mediante mysql
*/
class Class_conexion
{
    public $server;
    public $user;
    public $pass;
    public $base_datos;
    public $mysqli;
    public $db;
    public function __construct(
        $server,
        $user,
        $pass,
        $base_datos
    ) {
        $this->server = $server;
        $this->user = $user;
        $this->pass = $pass;
        $this->base_datos = $base_datos;

        //  Realizo la conexión
        $this->mysqli = new mysqli($server, $user, $pass, $base_datos);

        //  varificar la conexión
        if ($this->mysqli->connect_errno) {
            die('ERROR DE CONEXIÓN' . $this->mysqli->connect_error);
        }
    }
}