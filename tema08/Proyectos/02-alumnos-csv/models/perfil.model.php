<?php

/*
    perfil.model.php

    Modelo del controlador perfil

    Métodos:

        
*/

class perfilModel extends Model
{
    /*

        método: getUserId(int $id)

        descripción: obtiene un usuario por id

        @param: id del usuario

    */
    public function getUserId(int $id)
    {

        try {

            // sentencia sql
            $sql = "SELECT name, email, password FROM Users WHERE id = :id LIMIT 1"; 

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // Tipo de fetch
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            // vinculamos parámetros
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

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

        método: update($name, $email, $id)

        descripción: actualiza los datos del usuario

        @param: 

            - name: nombre del usuario
            - email: email del usuario
            
    */
    public function update($name, $email, $id)
    {

        try {

            // sentencia sql
            $sql = "UPDATE Users SET name = :name, email = :email WHERE id = :id";

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
        método: update_pass($password, $id)

        descripción: actualiza la contraseña del usuario

        @param: 

            - password: contraseña del usuario
            - id: id del usuario

    */
    public function updatePass($password, $id)
    {

        try {

            // encriptar password
            $password = password_hash($password, PASSWORD_DEFAULT);

            // sentencia sql
            $sql = "UPDATE Users SET password = :password WHERE id = :id";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // vinculamos parámetros
            $stmt->bindParam(':password', $password, PDO::PARAM_STR, 255);
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
        método: delete($id)

        descripción: elimina definitivamente un usuario. Tambien elimina los registros 
        asociados en la tabla de roles_users

        @param: 

            - id: id del usuario

    */
    public function delete($id)
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

    



}
