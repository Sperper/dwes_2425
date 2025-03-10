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
                    DATE  (fecha_def) AS fecha_def,
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

    /*
        método: update

        descripción: actualiza los detalles de un autor
        @param:
            - objeto de classAutor
            - id del autor
    */
    public function update(classAutor $autor, $id)
    {
        try {
            $sql = "UPDATE autores
                    SET
                        nombre = :nombre,
                        nacionalidad = :nacionalidad,
                        email = :email,
                        fecha_nac = :fecha_nac,
                        fecha_def = :fecha_def,
                        premios = :premios
                    WHERE
                        id = :id
                    LIMIT 1";
            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nombre', $autor->nombre, PDO::PARAM_STR, 50);
            $stmt->bindParam(':nacionalidad', $autor->nacionalidad, PDO::PARAM_STR, 30);
            $stmt->bindParam(':email', $autor->email, PDO::PARAM_STR, 50);
            $stmt->bindParam(':fecha_nac', $autor->fecha_nac, PDO::PARAM_STR);
            $stmt->bindParam(':fecha_def', $autor->fecha_def, PDO::PARAM_STR);
            $stmt->bindParam(':premios', $autor->premios, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            exit();
        }
    }

    /*
        método: delete

        descripción: elimina un autor
        @param: id del autor
    */
    public function delete(int $id)
    {
        try {
            $sql = "DELETE FROM autores
                    WHERE id = :id
                    LIMIT 1";
            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            exit();
        }
    }

    /*
        método: filter

        descripción: filtra los autores por una expresión
        @param: expresión a buscar
    */
    public function filter($expresion)
    {
        try {
            $sql = "SELECT 
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
                        CONCAT_WS(' ', nombre, nacionalidad, email, premios) LIKE :expresion
                    ORDER BY
                        id";
            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindValue(':expresion', '%' . $expresion . '%', PDO::PARAM_STR);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            exit();
        }
    }

    /*
        método: order

        descripción: ordena los autores por un campo
        @param: campo por el que ordenar
    */
    public function order(int $criterio)
    {
        try {
            $sql = "SELECT 
                        id,
                        nombre,
                        nacionalidad,
                        email,
                        DATE(fecha_nac) AS fecha_nac,
                        DATE(fecha_def) AS fecha_def,
                        premios
                    FROM 
                        autores
                    ORDER BY 
                        :criterio";
            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':criterio', $criterio, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            exit();
        }
    }

    /*
        método: validateIdAutor

        descripción: valida si un id de autor existe en la base de datos
        @param: id del autor
    */
    public function validateIdAutor(int $id)
    {
        try {
            $sql = "SELECT id FROM autores WHERE id = :id";
            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount() == 1;
        } catch (PDOException $e) {
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            exit();
        }
    }

    /*
        método: validateUniqueEmail

        descripción: valida si un email es único en la base de datos
        @param: email del autor
    */
    public function validateUniqueEmail(string $email)
    {
        try {
            $sql = "SELECT id FROM autores WHERE email = :email";
            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount() == 0;
        } catch (PDOException $e) {
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            exit();
        }
    }

    /*
        método: get_csv()

        Extrae los detalles de la tabla autores
    */
    public function get_csv()
    {
        try {
            $sql = "SELECT 
                        id,
                        nombre,
                        nacionalidad,
                        email,
                        DATE(fecha_nac) AS fecha_nac,
                        DATE(fecha_def) AS fecha_def,
                        premios
                    FROM 
                        autores
                    ORDER BY
                        id";
            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_NUM);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }

    /*
        método: import

        descripción: importa un fichero csv con los datos de los autores
        @param: $autores array con los datos del fichero csv
    */
    public function import($autores)
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
                    )";
            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            foreach ($autores as $autor) {
                $stmt->bindParam(':nombre', $autor[0], PDO::PARAM_STR, 50);
                $stmt->bindParam(':nacionalidad', $autor[1], PDO::PARAM_STR, 30);
                $stmt->bindParam(':email', $autor[2], PDO::PARAM_STR, 50);
                $stmt->bindParam(':fecha_nac', $autor[3], PDO::PARAM_STR);
                $stmt->bindParam(':fecha_def', $autor[4], PDO::PARAM_STR);
                $stmt->bindParam(':premios', $autor[5], PDO::PARAM_STR);
                $stmt->execute();
            }
            return count($autores);
        } catch (PDOException $e) {
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }

    /*
        método: get_pdf()

        Extrae los detalles de la tabla autores para generar un PDF
    */
    public function get_pdf()
    {
        try {
            $sql = "SELECT 
                        id,
                        nombre,
                        nacionalidad,
                        email,
                        DATE(fecha_nac) AS fecha_nac,
                        DATE(fecha_def) AS fecha_def,
                        premios
                    FROM 
                        autores
                    ORDER BY
                        id";
            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }
}