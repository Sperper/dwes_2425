<?php

/*
    alumnoModel.php

    Modelo del controlador alumno

    Métodos:

        - get()
*/

class albumModel extends Model
{

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
                titulo,
                descripcion,
                autor,
                fecha,
                lugar,
                categoria_id,
                num_fotos,
                num_visitas,
                carpeta
            FROM 
                albumes
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

    /*
       método: get_categorias()

       Extrae los detalles de las categorías para generar lista desplegable 
       dinámica
   */
    public function get_categorias()
    {
        try {
            // sentencia sql
            $sql = "SELECT 
                        id,
                        nombre
                    FROM 
                        categorias
                    ORDER BY
                        nombre";

            // conectamos con la base de datos
            $conexion = $this->db->connect();

            // ejecuto prepare
            $stmt = $conexion->prepare($sql);

            // establezco tipo fetch
            $stmt->setFetchMode(PDO::FETCH_KEY_PAIR);

            // ejecutamos
            $stmt->execute();

            // devuelvo objeto stmtatement
            return $stmt->fetchAll();
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

        descripción: añade nuevo alumno
        parámetros: objeto de classAlumno
    */

    public function create(classAlbum $album)
    {
        try {
            $sql = "INSERT INTO albumes (
                    titulo,
                    descripcion,
                    autor,
                    fecha,
                    lugar,
                    num_fotos,
                    num_visitas,
                    carpeta,
                    categoria_id
                )
                VALUES (
                    :titulo,
                    :descripcion,
                    :autor,
                    :fecha,
                    :lugar,
                    0,
                    0,
                    :carpeta,
                    :categoria_id
                )
            ";
            # Conectar con la base de datos
            $conexion = $this->db->connect();

            $stmt = $conexion->prepare($sql);

            

            $stmt->bindParam(':titulo', $album->titulo, PDO::PARAM_STR, 100);
            $stmt->bindParam(':descripcion', $album->descripcion, PDO::PARAM_STR, 255);
            $stmt->bindParam(':autor', $album->autor, PDO::PARAM_STR, 50);
            $stmt->bindParam(':fecha', $album->fecha, PDO::PARAM_STR);
            $stmt->bindParam(':lugar', $album->lugar, PDO::PARAM_STR, 100);
            $stmt->bindParam(':categoria_id', $album->categoria_id, PDO::PARAM_INT);
            $stmt->bindParam(':carpeta', $album->carpeta, PDO::PARAM_STR, 100);

            // añado album
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
                    titulo,
                    descripcion,
                    autor,
                    fecha,
                    lugar,
                    categoria_id,
                    num_fotos,
                    num_visitas,
                    carpeta
                FROM 
                    albumes
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

        descripción: actualiza los detalles de un álbum

        @param:
            - objeto de classAlbum
            - id del álbum
    */

    public function update(classAlbum $album, $id)
    {
        try {
            $sql = "
                UPDATE albumes
                SET
                    titulo = :titulo,
                    descripcion = :descripcion,
                    autor = :autor,
                    fecha = :fecha,
                    num_fotos = :num_fotos,
                    lugar = :lugar,
                    categoria_id = :categoria_id
                WHERE
                    id = :id
                LIMIT 1
            ";

            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);

            $num_fotos = count(glob("images/{$album->carpeta}/*.{jpg,png,gif}", GLOB_BRACE));
            $stmt->bindParam(':num_fotos', $num_fotos, PDO::PARAM_INT);

            
            
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':titulo', $album->titulo, PDO::PARAM_STR, 100);
            $stmt->bindParam(':descripcion', $album->descripcion, PDO::PARAM_STR, 255);
            $stmt->bindParam(':autor', $album->autor, PDO::PARAM_STR, 50);
            $stmt->bindParam(':fecha', $album->fecha, PDO::PARAM_STR);
            $stmt->bindParam(':lugar', $album->lugar, PDO::PARAM_STR, 100);
            $stmt->bindParam(':categoria_id', $album->categoria_id, PDO::PARAM_INT);

            $stmt->execute();
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
        método: delete

        descripción: elimina un alumno

        @param: id del alumno
    */

    public function delete(int $id)
    {

        try {

            $sql = "
                DELETE FROM albumes
                WHERE id = :id
                LIMIT 1
            ";

            $conexion = $this->db->connect();

            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->execute();
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
        método: filter

        descripción: filtra los alumnos por una expresión

        @param: expresión a buscar
    */
    public function filter($expresion)
    {
        try {
            $sql = "
            SELECT 
            id,
            titulo,
            descripcion,
            autor,
            fecha,
            lugar,
            categoria_id,
            num_fotos,
            num_visitas,
            carpeta
            FROM
            albumes
            WHERE
            CONCAT_WS(', ', 
                  id,
                  titulo,
                  descripcion,
                  autor,
                  fecha,
                  lugar,
                  categoria_id,
                  num_fotos,
                  num_visitas,
                  carpeta) 
            LIKE :expresion
            ORDER BY 
            id
            ";

            # Conectar con la base de datos
            $conexion = $this->db->connect();

            $stmt = $conexion->prepare($sql);

            $stmt->bindValue(':expresion', '%' . $expresion . '%', PDO::PARAM_STR);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();
            return $stmt;
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
        método: order

        descripción: ordena los alumnos por un campo

        @param: campo por el que ordenar
    */
    public function order(string $criterio)
    {
        try {
            # comando sql
            $sql = "
            SELECT 
                id,
                titulo,
                descripcion,
                autor,
                fecha,
                lugar,
                categoria_id,
                num_fotos,
                num_visitas,
                carpeta
            FROM
                albumes
            ORDER BY 
                $criterio
            ";

            # conectamos con la base de datos
            $conexion = $this->db->connect();

            # ejecutamos mediante prepare
            $stmt = $conexion->prepare($sql);

            # establecemos tipo fetch
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            # ejecutamos 
            $stmt->execute();

            # devuelvo objeto stmtatement
            return $stmt;
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
        método: validateUniqueDni

        descripción: valida el DNI de un alumno. Que no exista en la base de datos

        @param: 
            - dni del alumno

    */
    public function validateUniqueDNI($dni) {

        try {

            $sql = "
                SELECT 
                    dni
                FROM 
                    alumnos
                WHERE
                    dni = :dni
            ";

            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':dni', $dni, PDO::PARAM_STR, 9);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return FALSE;
            } 

            return TRUE;
            

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
        método: validateUniqueEmail

        descripción: valida el email de un alumno. Que no exista en la base de datos

        @param: 
            - email del alumno

    */
    public function validateUniqueEmail($email) {

        try {

            $sql = "
                SELECT 
                    email
                FROM 
                    alumnos
                WHERE
                    email = :email
            ";

            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR, 50);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return FALSE;
            } 

            return TRUE;
            

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
        método: validateForeignKeyCurso($id_curso)

        descripción: valida el id_curso seleccionado. Que exista en la tabla cursos

        @param: 
            - $id_curso

    */
    public function validateForeignKeyCurso(int $id_curso) {

        try {

            $sql = "
                SELECT 
                    id
                FROM 
                    cursos
                WHERE
                    id = :id_curso
            ";

            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
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

    public function validateIdAlbum(int $id)
    {
        try {
            $sql = "SELECT id FROM albumes WHERE id = :id";
            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() == 1) {
                return TRUE;
            }

            return FALSE;
        } catch (PDOException $e) {
            require_once 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            exit();
        }
    }

    public function update_visitas(int $id)
    {
        try {
            $sql = "UPDATE albumes SET num_visitas = num_visitas + 1 WHERE id = :id";
            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            require_once 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            exit();
        }
    }

    
}
