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
        método: validateUniqueName()

        Valida el name de usuario, devuelve verdadero si el  nombre no existe en la base de datos


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
        método: getUserEmail()

        descripción: obtiene un usuario por email
        
        @param: email del usuario

    */
    public function getUserEmail($email)
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

            // vinculamos parámetros
            $stmt->bindParam(':email', $email, PDO::PARAM_STR, 50);

            // ejecutamos
            $stmt->execute();

            // Devuelvo objeto usuario
            return $stmt->fetch();

        } catch (PDOException $e) {

            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }

    /*
        método: getIdPerfilUser()

        descripción: obtiene el id del perfil de un usuario
        
        @param: id del usuario

    */
    public function getIdPerfilUser(int $id)
    {

        try {

            // sentencia sql
            $sql = "SELECT role_id FROM roles_users WHERE user_id = :user_id LIMIT 1"; 

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // Tipo de fetch
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            // vinculamos parámetros
            $stmt->bindParam(':user_id', $id, PDO::PARAM_INT);

            // ejecutamos
            $stmt->execute();

            // Devuelvo el id del perfil
            return $stmt->fetch()->role_id;

        } catch (PDOException $e) {

            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }

    /*
        método: getNamePerfil($role_id)

        descripción: obtiene el nombre del perfil de un usuario
        
        @param: id del perfil

    */
    public function getNamePerfil(int $role_id)
    {

        try {

            // sentencia sql
            $sql = "SELECT name FROM roles WHERE id = :role_id LIMIT 1"; 

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // Tipo de fetch
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            // vinculamos parámetros
            $stmt->bindParam(':role_id', $role_id, PDO::PARAM_INT);

            // ejecutamos
            $stmt->execute();

            // Devuelvo objeto perfil
            return $stmt->fetch()->name;

        } catch (PDOException $e) {

            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }



}
