<?php

/*
    alumnoModel.php

    Modelo del controlador alumno

    Métodos:

        - get()
*/

class libroModel extends Model
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
                libros.id,
                libros.titulo,
                libros.precio,
                libros.stock,
                libros.fecha_edicion,
                libros.isbn,
                autores.nombre autor,
                editoriales.nombre editorial,
                GROUP_CONCAT(generos.tema) generos
            FROM 
                libros 
            INNER JOIN
                autores
            ON 
                libros.autor_id = autores.id
            INNER JOIN
                editoriales
            ON
                libros.editorial_id = editoriales.id
            LEFT JOIN
                generos
            ON
                FIND_IN_SET(generos.id, libros.generos_id)
            GROUP BY
                libros.id
            ORDER BY
                libros.id";

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
       método: get_autores()

       Extre los detalles de los autores para generar lista desplegable 
       dinámica
   */
    public function get_autores()
    {

        try {

            // sentencia sql
            $sql = "SELECT 
                        id,
                        nombre as autor
                    FROM 
                        autores
                    ORDER BY
                    2
            ";

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
         método: get_editoriales()
    
         Extre los detalles de las editoriales para generar lista desplegable 
         dinámica
    */
    public function get_editoriales()
    {

        try {

            // sentencia sql
            $sql = "SELECT 
                        id,
                        nombre as editorial
                    FROM 
                        editoriales
                    ORDER BY
                    2
            ";

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
        método: get_generos()

        Extre los detalles de los generos.
    */
    public function get_generos()
    {
        try {
            $sql = "SELECT 
                        id,
                        tema as genero
                    FROM 
                        generos
                    ORDER BY
                    2
            ";

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
        método: get_titulos_generos()
        
        

    */

    /*
        método: create

        descripción: añade un libro a la base de datos
        parámetros: objeto de classLibro
    */

    public function create(classLibro $libro)
    {

        try {
            $sql = "INSERT INTO libros (
                    titulo,
                    precio,
                    stock,
                    fecha_edicion,
                    isbn,
                    autor_id,
                    editorial_id,
                    generos_id
                )
                VALUES (
                    :titulo,
                    :precio,
                    :stock,
                    :fecha_edicion,
                    :isbn,
                    :autor_id,
                    :editorial_id,
                    :generos_id
                )
            ";
            # Conectar con la base de datos
            $conexion = $this->db->connect();


            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(':titulo', $libro->titulo, PDO::PARAM_STR, 30);
            $stmt->bindParam(':precio', $libro->precio, PDO::PARAM_STR, 6);
            $stmt->bindParam(':stock', $libro->stock, PDO::PARAM_INT);
            $stmt->bindParam(':fecha_edicion', $libro->fecha_edicion, PDO::PARAM_STR);
            $stmt->bindParam(':isbn', $libro->isbn, PDO::PARAM_STR, 13);
            $stmt->bindParam(':autor_id', $libro->autor_id, PDO::PARAM_INT);
            $stmt->bindParam(':editorial_id', $libro->editorial_id, PDO::PARAM_INT);
            $stmt->bindParam(':generos_id', $libro->generos_id, PDO::PARAM_STR);


            // añado libro
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
                            precio,
                            stock,
                            fecha_edicion,
                            isbn,
                            autor_id,
                            editorial_id,
                            generos_id
                    FROM 
                            libros
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
            // // error base de datos
            require_once 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            exit();
        }
    }

    /*
        método: update

        descripción: actualiza los detalles de un alumno

        @param:
            - objeto de classAlumno
            - id del alumno
    */

    public function update(classLibro $libro, $id)
    {

        try {

            $sql = "
            
            UPDATE libros
            SET
                    titulo = :titulo,
                    precio = :precio,
                    stock = :stock,
                    fecha_edicion = :fecha_edicion,
                    isbn = :isbn,
                    autor_id = :autor_id,
                    editorial_id = :editorial_id,
                    generos_id = :generos_id
            WHERE
                    id = :id
            LIMIT 1
            ";

            $conexion = $this->db->connect();

            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->bindParam(':titulo', $libro->titulo, PDO::PARAM_STR, 30);
            $stmt->bindParam(':precio', $libro->precio, PDO::PARAM_STR, 6);
            $stmt->bindParam(':stock', $libro->stock, PDO::PARAM_INT);
            $stmt->bindParam(':fecha_edicion', $libro->fecha_edicion, PDO::PARAM_STR);
            $stmt->bindParam(':isbn', $libro->isbn, PDO::PARAM_STR, 13);
            $stmt->bindParam(':autor_id', $libro->autor_id, PDO::PARAM_INT);
            $stmt->bindParam(':editorial_id', $libro->editorial_id, PDO::PARAM_INT);
            $stmt->bindParam(':generos_id', $libro->generos_id, PDO::PARAM_STR);

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
                DELETE FROM libros
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
        método: filter

        descripción: filtra los libros por una expresión

        @param: expresión a buscar
    */
    public function filter($expresion)
    {
        try {
            $sql = "
            SELECT 
                libros.id,
                libros.titulo,
                libros.precio,
                libros.stock,
                libros.fecha_edicion,
                libros.isbn,
                autores.nombre autor,
                editoriales.nombre editorial,
                GROUP_CONCAT(generos.tema) generos
            FROM 
                libros 
            INNER JOIN
                autores
            ON 
                libros.autor_id = autores.id
            INNER JOIN
                editoriales
            ON
                libros.editorial_id = editoriales.id
            LEFT JOIN
                generos
            ON
                FIND_IN_SET(generos.id, libros.generos_id)
            WHERE
                CONCAT_WS(' ', libros.titulo, 
                autores.nombre, 
                editoriales.nombre, 
                generos.tema,
                libros.titulo,
                libros.precio,
                libros.stock,
                libros.fecha_edicion,
                libros.isbn
                ) LIKE :expresion
            GROUP BY
                libros.id
            ORDER BY
                libros.id
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
    public function order(int $criterio)
    {

        try {

            # comando sql
            $sql = "
            SELECT 
                libros.id,
                libros.titulo,
                libros.precio,
                libros.stock,
                libros.fecha_edicion,
                libros.isbn,
                autores.nombre autor,
                editoriales.nombre editorial,
                GROUP_CONCAT(generos.tema) generos
            FROM 
                libros 
            INNER JOIN
                autores
            ON 
                libros.autor_id = autores.id
            INNER JOIN
                editoriales
            ON
                libros.editorial_id = editoriales.id
            LEFT JOIN
                generos
            ON
                FIND_IN_SET(generos.id, libros.generos_id)
            GROUP BY
                libros.id
            ORDER BY 
                :criterio
            ";

            # conectamos con la base de datos

            // $this->db es un objeto de la clase database
            // ejecuto el método connect de esa clase

            $conexion = $this->db->connect();

            # ejecutamos mediante prepare
            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(':criterio', $criterio, PDO::PARAM_INT);

            # establecemos  tipo fetch
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            #  ejecutamos 
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
}
