<?php

/*
    auth.model.php

    Modelo del controlador auth

    Métodos:

        - validateName
*/

class authModel extends Model
{

    /*
        método: validateName()

        Valida el name de usuario, devuelve verdadero si no existe el nombre

        @param: name del usuario
    */
    public function validateUniqueName($name)
    {

        try {

            // sentencia sql
            $sql = "SELECT * FROM Users WHERE name = :name";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // Vinculamos parametros
            $stmt->bindParam(":name", $name, PDO::PARAM_STR, 50);

            // ejecutamos
            $stmt->execute();

            if($stmt->rowCount() > 0) {
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

        Valida el email de usuario, devuelve verdadero si no existe el email

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

            // Vinculamos parametros
            $stmt->bindParam(":email", $email, PDO::PARAM_STR, 50);

            // ejecutamos
            $stmt->execute();

            if($stmt->rowCount() > 0) {
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
        metodo: create()

        descripcion: crea un nuevo usuario en la base de datos

        @param: name del usuario, email, del usuario, password del usuario
    */
    public function create($name, $email, $password)
    {
        try {
            // sentencia sql
            $sql = "INSERT INTO Users (name, email, password) VALUES (:name, :email, :password)";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // Vinculamos parametros
            $stmt->bindParam(":name", $name, PDO::PARAM_STR, 50);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR, 50);
            $stmt->bindParam(":password", password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);

            // ejecutamos
            $stmt->execute();

            // Devuelvo id asignado al nuevo usuario
            return $conexion->lastInsertId();;

        } catch (PDOException $e) {

            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            return FALSE;
        }
    }


    /*
        método: validateIdAlumno

        descripción: valida el id de un alumno. Que exista en la base de datos

        @param: 
            - id del alumno

    */

    public function validateIdAlumno(int $id) {

        try {

            $sql = "
                SELECT 
                    id
                FROM 
                    alumnos
                WHERE
                    id = :id
            ";

            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() == 1) {
                return TRUE;
            } 

            return FALSE;
            

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
        método: assignRole(int $id, int $role)

        descripcion: asgina un ron a un suario

        @param: id del usuario, rol del usuario
    */

    public function assignRole(int $id, int $role)
    {
        try {
            // sentencia sql
            $sql = "INSERT INTO roles_users (user_id, role_id) VALUES (:id, :role)";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // Vinculamos parametros
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":role", $role, PDO::PARAM_INT);

            // ejecutamos
            $stmt->execute();

            return TRUE;

        } catch (PDOException $e) {

            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            return FALSE;
        }
    }

    /*
        método: getUserByEmail

        descripción: obtiene un usuario por su email

        @param: email del usuario
    */
    public function getUserByEmail($email)
    {
        try {
            // sentencia sql
            $sql = "SELECT * FROM Users WHERE email = :email LIMIT 1";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // Tipo de fetch
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            // Vinculamos parametros
            $stmt->bindParam(":email", $email, PDO::PARAM_STR, 50);

            // ejecutamos
            $stmt->execute();

            // Devuelvo el usuario encontrado
            return $stmt->fetch();

        } catch (PDOException $e) {

            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            return FALSE;
        }
    }

    /*
        metodo: getPerfilUser

        descripcion: obtiene el id del perfil de un usuario

        @param: id del usuario
    */

    public function getPerfilUser(int $id)
    {
        try {
            // sentencia sql
            $sql = "SELECT perfil_id FROM Users WHERE user_id = :user_id LIMIT 1";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // Vinculamos parametros
            $stmt->bindParam(":user_id", $id, PDO::PARAM_INT);

            // ejecutamos
            $stmt->execute();

            // Devuelvo el perfil_id encontrado
            return $stmt->fetchColumn();

        } catch (PDOException $e) {

            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            return FALSE;
        }
    }

    
        

        /*
            método: getNombrePerfil

            descripción: obtiene el nombre del perfil de un usuario

            @param: id del perfil
        */
        public function getNombrePerfil(int $role_id)
        {
            try {
                // sentencia sql
                $sql = "SELECT name FROM roles WHERE id = :role_id LIMIT 1";

                // conectamos con la base de datos
                $conexion = $this->db->connect();

                // ejecuto prepare
                $stmt = $conexion->prepare($sql);

                // Vinculamos parametros
                $stmt->bindParam(":role_id", $role_id, PDO::PARAM_INT);

                // ejecutamos
                $stmt->execute();

                // Devuelvo el nombre del perfil encontrado
                return $stmt->fetchColumn();

            } catch (PDOException $e) {

                // error base de datos
                require 'template/partials/errorDB.partial.php';
                $stmt = null;
                $conexion = null;
                $this->db = null;
                return FALSE;
            }
        }
    
}
