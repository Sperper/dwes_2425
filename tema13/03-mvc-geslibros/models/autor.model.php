<?php

/*
    alumnoModel.php

    Modelo del controlador alumno

    Métodos:

        - get()
*/

class autorModel extends Model {
    /*
        método: get()

        Extre los detalles de la tabla alumnos
    */
    public function get()
    {

        try {

            // sentencia sql
            $sql = "SELECT 
            autores.id,
            autores.nombre,
            autores.nacionalidad,
            autores.email,
            DATE(autores.fecha_nac) AS fecha_nac,
            DATE(autores.fecha_def) AS fecha_def,
            autores.premios
            FROM 
            autores
            ORDER BY
            autores.id";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // establezco tipo fetch
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            // ejecutamos
            $stmt->execute();

            // devuelvo objeto stmtatement
            return $stmt;
        } catch (PDOException $e) {

            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }

    /*
        método: create

        descripción: añade un autor a la base de datos
        parámetros: objeto de classAutor
    */

    public function create(classAutor $autor)
    {

        try {
            $sql = "INSERT INTO autores (
                    nombre,
                    nacionalidad,
                    email,
                    fecha_nac,
                    fecha_def,
                    premios
                )
                VALUES (
                    :nombre,
                    :nacionalidad,
                    :email,
                    :fecha_nac,
                    :fecha_def,
                    :premios
                )
            ";
            # Conectar con la base de datos
            $conexion = $this->db->connect();


            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(':nombre', $autor->nombre, PDO::PARAM_STR, 50);
            $stmt->bindParam(':nacionalidad', $autor->nacionalidad, PDO::PARAM_STR, 30);
            $stmt->bindParam(':email', $autor->email, PDO::PARAM_STR, 50);
            $stmt->bindParam(':fecha_nac', $autor->fecha_nac, PDO::PARAM_STR);
            $stmt->bindParam(':fecha_def', $autor->fecha_def, PDO::PARAM_STR);
            $stmt->bindParam(':premios', $autor->premios, PDO::PARAM_STR);


            // añado autor
            $stmt->execute();
        } catch (PDOException $e) {
            // error base de datos
            require_once 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }

    /*
        método: read

        descripción: obtiene los detalles de un alumno
        parámetros: id del alumno
        devuelve: objeto con los detalles del alumno
        
    */

    public function read(int $id)
    {

        try {
            $sql = "
                SELECT 
                    id,
                    nombre,
                    nacionalidad,
                    email,
                    DATE(fecha_nac) AS fecha_nac,
                    DATE(fecha_def) AS fecha_def,
                    premios
                FROM 
                    autores
                WHERE
                    id = :id
                LIMIT 1
            ";

            # Conectar con la base de datos
            $conexion = $this->db->connect();

            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();

            return $stmt->fetch();
        } catch (PDOException $e) {
            // error base de datos
            require_once 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            exit();
        }
    }
}