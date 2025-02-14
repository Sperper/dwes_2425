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

    /*
        método: validateIdLibro

        descripción: valida si un id de libro existe en la base de datos

        @param: 
            - id del libro
    */


    public function validateIdLibro(int $id) {

        try {

            $sql = "
                SELECT 
                    id
                FROM 
                    libros
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
        método: validateUniqueISBN

        descripción: valida si un ISBN es único en la base de datos

        @param: 
            - isbn del libro
    */
    public function validateUniqueISBN(string $isbn) {
        try {
            $sql = "SELECT id FROM libros WHERE isbn = :isbn";
            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':isbn', $isbn, PDO::PARAM_STR);
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
        método: validateForeignKeyAutor

        descripción: valida si un id de autor existe en la base de datos

        @param: 
            - id del autor
    */
    public function validateForeignKeyAutor(string $nombre_autor) {
        try {
            $sql = "SELECT id FROM autores WHERE nombre = :nombre_autor";
            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':nombre_autor', $nombre_autor, PDO::PARAM_STR);
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
        método: validateForeignKeyEditorial

        descripción: valida si un nombre de editorial existe en la base de datos

        @param: 
            - nombre de la editorial
    */
    public function validateForeignKeyEditorial(string $nombre_editorial) {
        try {
            $sql = "SELECT id FROM editoriales WHERE nombre = :nombre_editorial";
            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':nombre_editorial', $nombre_editorial, PDO::PARAM_STR);
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

        Extrae los detalles de la tabla libros
    */
    public function get_csv()
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
            $stmt->setFetchMode(PDO::FETCH_NUM);

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
        método: import

        descripción: importa un fichero csv con los datos de los alumnos

        @param: 

            - $libros array con los datos del fichero csv

    */
    public function import($libros) {

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

            foreach ($libros as $libro) {

                $generos_id = implode(',', $this->get_generos_id($libro[7]));
                $autor_id = $this->get_autor_id($libro[5]);
                $editorial_id = $this->get_editorial_id($libro[6]);

                
                

                $stmt->bindParam(':titulo', $libro[0], PDO::PARAM_STR, 30);
                $stmt->bindParam(':precio', $libro[1], PDO::PARAM_STR, 50);
                $stmt->bindParam(':stock', $libro[2], PDO::PARAM_INT);
                $stmt->bindParam(':fecha_edicion', $libro[3], PDO::PARAM_STR);
                $stmt->bindParam(':isbn', $libro[4], PDO::PARAM_STR, 13);
                $stmt->bindParam(':autor_id', $autor_id, PDO::PARAM_INT);
                $stmt->bindParam(':editorial_id', $editorial_id, PDO::PARAM_INT);
                $stmt->bindParam(':generos_id', $generos_id, PDO::PARAM_STR);

                // añado libro
                $stmt->execute();
            }

            // devuelvo el número de libros importados
            return count($libros);

        } catch (PDOException $e) {
            // error base de datos
            require_once 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }

    /*
        método: get_generos_id

        descripción: recibe un string con los nombres de los generos separados por comas y devuelve los id de esos generos

        @param: 
            - string $generos_nombres
    */
    public function get_generos_id(string $generos_nombres)
    {
        try {
            $generos_array = explode(',', $generos_nombres);
            $placeholders = implode(',', array_fill(0, count($generos_array), '?'));

            $sql = "SELECT id FROM generos WHERE tema IN ($placeholders)";
            
            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            
            foreach ($generos_array as $index => $genero) {
                $stmt->bindValue($index + 1, trim($genero), PDO::PARAM_STR);
            }

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_COLUMN);
        } catch (PDOException $e) {
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            exit();
        }
    }

    /*
        método: validateGenerosExist

        descripción: valida que los generos que están en el csv existan en la base de datos

        @param: 
            - string $generos_nombres
    */
    public function validateGenerosExist(string $generos_nombres)
    {
        try {
            $generos_array = explode(',', $generos_nombres);
            $placeholders = implode(',', array_fill(0, count($generos_array), '?'));

            $sql = "SELECT COUNT(*) FROM generos WHERE tema IN ($placeholders)";
            
            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            
            foreach ($generos_array as $index => $genero) {
                $stmt->bindValue($index + 1, trim($genero), PDO::PARAM_STR);
            }

            $stmt->execute();
            $count = $stmt->fetchColumn();

            return $count == count($generos_array);
        } catch (PDOException $e) {
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            exit();
        }
    }

    /*
        método: get_autor_id

        descripción: recibe el nombre del autor y devuelve su id

        @param: 
            - string $nombre_autor
    */
    public function get_autor_id(string $nombre_autor)
    {
        try {
            $sql = "SELECT id FROM autores WHERE nombre = :nombre_autor";
            
            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':nombre_autor', $nombre_autor, PDO::PARAM_STR);
            
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            exit();
        }
    }

    /*
        método: get_editorial_id

        descripción: recibe el nombre de la editorial y devuelve su id

        @param: 
            - string $nombre_editorial
    */
    public function get_editorial_id(string $nombre_editorial)
    {
        try {
            $sql = "SELECT id FROM editoriales WHERE nombre = :nombre_editorial";
            
            $conexion = $this->db->connect();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':nombre_editorial', $nombre_editorial, PDO::PARAM_STR);
            
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            require 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
            exit();
        }
    }

}
