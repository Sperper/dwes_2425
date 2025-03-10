<?php

/*
    alumnoModel.php

    Modelo del controlador alumno

    Métodos:

        - get()
*/

class usuarioModel extends Model {
    /*
        método: get()

        Extre los detalles de la tabla alumnos
    */
    public function get()
    {

        try {

            // sentencia sql
            $sql = "SELECT 
                id,
                name,
                email,
                password
            FROM 
                users 
            GROUP BY
                id
            ORDER BY
                id";

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


    public function validateUniqueName($name)
    {

        try {

            // sentencia sql
            $sql = "SELECT * FROM Users WHERE name = :name"; 


            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // vinculamos parámetros
            $stmt->bindParam(':name', $name, PDO::PARAM_STR, 50);

            // ejecutamos
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return FALSE;
            } 

            return TRUE;

        } catch (PDOException $e) {

            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }

    /*
        método: validateUniqueEmail()

        descripción: comprueba si un email ya existe en la base de datos, 
        devuelve verdadero si es un valor único
        
        @param: email del usuario

    */
    public function validateUniqueEmail($email)
    {

        try {

            // sentencia sql
            $sql = "SELECT * FROM Users WHERE email = :email"; 

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // vinculamos parámetros
            $stmt->bindParam(':email', $email, PDO::PARAM_STR, 50);

            // ejecutamos
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return FALSE;
            } 

            return TRUE;

        } catch (PDOException $e) {

            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }

     /*
        método: create()

        descripción: crea un nuevo usuario en la base de datos
        
        @param: name del usuario, email del usuario, password del usuario

    */
    public function create($name, $email, $password)
    {

        try {

            // encriptamos la contraseña
            $password = password_hash($password, PASSWORD_DEFAULT);

            // sentencia sql
            $sql = "INSERT INTO Users (name, email, password) 
            VALUES (:name, :email, :password)"; 

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // vinculamos parámetros
            $stmt->bindParam(':name', $name, PDO::PARAM_STR, 50);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR, 50);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR, 255);

            // ejecutamos
            $stmt->execute();

            // Devuelvo id asignado al nuevo usuario
            return $conexion->lastInsertId();
            

        } catch (PDOException $e) {

            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }

     /*
        método: assignRole(int $id, int $role)

        descripción: asigna un rol a un usuario
        
        @param: id del usuairo, role del usuario

    */
    public function assignRole($id, $role)
    {

        try {

            // sentencia sql
            $sql = "INSERT INTO roles_users (user_id, role_id) 
            VALUES (:user_id, :role_id)"; 

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // vinculamos parámetros
            $stmt->bindParam(':user_id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':role_id', $role, PDO::PARAM_INT);

            // ejecutamos
            $stmt->execute();

        } catch (PDOException $e) {

            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }

    /*
        método: read(int $id)

        descripción: lee los datos de un usuario
    */

    public function read(int $id)
    {

        try {
            $sql = "
                    SELECT 
                            id,
                            name,
                            email,
                            password
                    FROM 
                            users
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

        método: update($name, $email, $id)

        descripción: actualiza los datos del usuario

        @param: 

            - name: nombre del usuario
            - email: email del usuario
            
    */
    public function update($name, $email, $id, $password = null)
    {

        try {

            // sentencia sql
            if(!is_null($password)) {
                $sql = "UPDATE Users SET name = :name, email = :email, password = :password WHERE id = :id";
            } else {
                $sql = "UPDATE Users SET name = :name, email = :email WHERE id = :id";
            }

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // vinculamos parámetros
            $stmt->bindParam(':name', $name, PDO::PARAM_STR, 50);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR, 50);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // ejecutamos
            $stmt->execute();

            // Devuelvo objeto usuario
            return $stmt->rowCount();

        } catch (PDOException $e) {

            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }

    /*
        método: delete(int $id)

        descripción: elimina un usuario de la base de datos
    */
    public function delete(int $id)
    {

        try {

            // sentencia sql
            $sql = "DELETE FROM Users WHERE id = :id";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // vinculamos parámetros
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // ejecutamos
            $stmt->execute();

            // Devuelvo objeto usuario
            return $stmt->rowCount();

        } catch (PDOException $e) {

            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }

    /*
        método: filter

        descripción: filtra los usuarios por una expresión

        @param: expresión a buscar
    */
    public function filter($expresion)
    {
        try {
            $sql = "
            SELECT 
                id,
                name,
                email,
                password
            FROM 
                users
            WHERE
                CONCAT_WS(' ', name, email) LIKE :expresion
            ORDER BY
                id
            ";

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

        descripción: ordena los usuarios por un campo

        @param: campo por el que ordenar
    */
    public function order($criterio)
    {
        try {
            $sql = "
            SELECT 
                id,
                name,
                email,
                password
            FROM 
                users
            ORDER BY 
                :criterio
            ";

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
        método: validateIdUsuario

        descripción: valida si un id de usuario existe en la base de datos

        @param: 
            - id del usuario
    */
    public function validateIdUsuario(int $id)
    {
        try {
            $sql = "
                SELECT 
                    id
                FROM 
                    users
                WHERE
                    id = :id
            ";

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
        método: get_csv()

        Extrae los detalles de la tabla usuarios
    */
    public function get_csv()
    {
        try {
            $sql = "
            SELECT 
                id,
                name,
                email,
                password
            FROM 
                users
            ORDER BY
                id
            ";

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
        método: get_pdf()

        Extrae los detalles de la tabla usuarios para generar un PDF
    */
    public function get_pdf()
    {
        try {
            $sql = "
            SELECT 
                id,
                name,
                email,
                password
            FROM 
                users
            ORDER BY
                id
            ";

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