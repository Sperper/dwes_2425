<?php

/*
    libroModel.php

    Modelo del controlador libro

    Métodos:

        - get()
*/

class libroModel extends Model
{

    /*
        método: get()

        Extre los detalles de la tabla libros
    */
    public function get()
    {

        try {

            $sql = "SELECT 
            li.id,
            li.titulo,
            au.nombre as autor,
            ed.nombre as editorial,
            fecha_edicion,
            generos_id,
            stock,
            precio
        FROM 
            libros li
        INNER JOIN  
            autores au
        ON 
            au.id = li.autor_id
        INNER JOIN 
            editoriales ed
        ON 
            ed.id = li.editorial_id
        ORDER BY
            li.id
        ASC;";

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

       método: get_generos()

       lista dfesplegable de géneros

   */
    public function get_generos()
    {

        try {
            $sql = "SELECT 
                    id,
                    tema
                FROM 
                    generos
                ORDER BY
                    tema ASC;";


            $conexion = $this->db->connect();


            $stmt = $conexion->prepare($sql);


            $stmt->setFetchMode(PDO::FETCH_KEY_PAIR);


            $stmt->execute();



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

       método: get_nombre_generos()

   */
    public function get_nombre_generos($generos)
    {
        try {
            $array_id_generos = explode(',', $generos);
            $array_nombre_generos = $this->get_generos();


            $array_generos = [];

            foreach ($array_id_generos as $id_genero) {


                $array_generos[] = $array_nombre_generos[$id_genero];
            }



            return implode(', ', $array_generos);
        } catch (PDOException $e) {
            // error base de datos
            require 'template/partials/errorDB.partial.php';
            $this->db = null;
        }
    }





    /*
       método: get_autores()

       Generar lista desplegable de autores

   */
    public function get_autores()
    {

        try {

            $sql = "SELECT 
                id,
                nombre
            FROM 
                autores
            ORDER BY
                nombre ASC;";

            $conexion = $this->db->connect();


            $stmt = $conexion->prepare($sql);

            $stmt->setFetchMode(PDO::FETCH_KEY_PAIR);

            $stmt->execute();


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

         lista desplegable de editoriales
     */
    public function get_editoriales()
    {

        try {

            $sql = "SELECT 
            id,
            nombre
        FROM 
            editoriales
        ORDER BY
            nombre ASC;";


            $conexion = $this->db->connect();


            $stmt = $conexion->prepare($sql);

            $stmt->setFetchMode(PDO::FETCH_KEY_PAIR);

            $stmt->execute();

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
        método: read

        descripción: obtiene los detalles de un libro
        parámetros: id del libro
        devuelve: objeto con los detalles del libro
        
    */

    public function read(int $id)
    {

        try {
            $sql = "SELECT 
                        libros.id,
                        libros.titulo,
                        autores.id AS autor_id,
                        autores.nombre AS autor,
                        editoriales.id AS editorial_id,
                        editoriales.nombre AS editorial,
                        libros.generos_id,
                        libros.stock,
                        libros.precio,
                        libros.fecha_edicion,
                        libros.isbn
                    FROM 
                        libros 
                    INNER JOIN
                        autores
                    ON autores.id = libros.autor_id
                    INNER JOIN
                        editoriales
                    ON editoriales.id = libros.editorial_id
                    WHERE
                        libros.id = :id
                    LIMIT 1";

            $conexion = $this->db->connect();


            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();

            $libro = $stmt->fetch();


            if ($libro) {
                // Convierte generos_id en un array
                $libro->generos = explode(',', $libro->generos_id);
            }

            return $libro;
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

        descripción: actualiza los detalles de un libro

    */

    public function update(classLibro $libro, $id)
    {

        try {

            $sql = "UPDATE libros SET 
            titulo = :titulo,
            precio = :precio,
            stock = :stock,
            fecha_edicion = :fecha_edicion,
            isbn = :isbn,
            autor_id = :autor_id,
            editorial_id = :editorial_id,
            generos_id = :generos_id,
            update_at = CURRENT_TIMESTAMP
        WHERE 
            id = :id
    ";

            $conexion = $this->db->connect();

            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->bindParam(':titulo', $libro->titulo, PDO::PARAM_STR, 80);
            $stmt->bindParam(':precio', $libro->precio, PDO::PARAM_STR);
            $stmt->bindParam(':stock', $libro->stock, PDO::PARAM_INT);
            $stmt->bindParam(':fecha_edicion', $libro->fecha_edicion, PDO::PARAM_STR);
            $stmt->bindParam(':isbn', $libro->isbn, PDO::PARAM_STR, 13);
            $stmt->bindParam(':autor_id', $libro->autor_id, PDO::PARAM_INT);
            $stmt->bindParam(':editorial_id', $libro->editorial_id, PDO::PARAM_INT);
            $stmt->bindParam(':generos_id', implode(",", $libro->generos_id), PDO::PARAM_STR);

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
        método: create

        descripción: añade nuevo libro
        parámetros: objeto de classLibro
    */

    public function create(classLibro $libro)
    {

        try {
            $sql = "INSERT INTO
            libros (
                    titulo,
                    precio,
                    stock,
                    fecha_edicion,
                    isbn,
                    autor_id,
                    editorial_id,
                    generos_id
                    )
                VALUES 
                (
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

            $conexion = $this->db->connect();

            //Necesitamos preparar la conexión
            $stmt = $conexion->prepare($sql);

            // Vinculamos los parámetros directamente de esta forma
            $stmt->bindParam(':titulo', $libro->titulo, PDO::PARAM_STR, 100);
            $stmt->bindParam(':precio', $libro->precio, PDO::PARAM_STR, 10);
            $stmt->bindParam(':stock', $libro->stock, PDO::PARAM_INT);
            $stmt->bindParam(':fecha_edicion', $libro->fecha_edicion, PDO::PARAM_STR, 10);
            $stmt->bindParam(':isbn', $libro->isbn, PDO::PARAM_INT);
            $stmt->bindParam(':autor_id', $libro->autor_id, PDO::PARAM_INT);
            $stmt->bindParam(':editorial_id', $libro->editorial_id, PDO::PARAM_INT);
            $stmt->bindParam(':generos_id', implode(",", $libro->generos_id), PDO::PARAM_STR);


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
        método: delete

        descripción: elimina un libro

        @param: id del libro
    */

    public function delete(int $id)
    {

        try {

            $sql = "DELETE FROM libros WHERE id = :id LIMIT 1";

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
        método: order

        descripción: ordena los libros por un campo

        @param: campo por el que ordenar
    */
    public function order(int $criterio)
    {

        try {

            $sql = "SELECT 
                    li.id,
                    li.titulo,
                    au.nombre as autor,
                    ed.nombre as editorial,
                    fecha_edicion,
                    generos_id,
                    stock,
                    precio
                FROM 
                    libros as li
                INNER JOIN  
                    autores as au
                ON 
                    au.id = li.autor_id
                INNER JOIN 
                    editoriales as ed
                ON 
                    ed.id = li.editorial_id
                ORDER BY
                    :criterio
                ASC;";

            $conexion = $this->db->connect();

            # ejecutamos mediante prepare
            $stmt = $conexion->prepare($sql);

            // vincular el criterio de búsqueda como parámetro
            $stmt->bindParam(':criterio', $criterio, PDO::PARAM_INT);



            // Tipo de fetch
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
        método: filter

        descripción: filtra los libros por una expresión

        @param: expresión a buscar
    */
    public function filter($expresion)
    {
        try {
            $sql = "SELECT 
            li.id,
            li.titulo,
            au.nombre AS autor,
            ed.nombre AS editorial,
            li.fecha_edicion,
            li.generos_id,
            li.stock,
            li.precio
        FROM 
            libros as li
        INNER JOIN  
            autores as au
        ON 
            au.id = li.autor_id
        INNER JOIN 
            editoriales as ed
        ON 
            ed.id = li.editorial_id
        WHERE
            CONCAT_WS(' ', 
                li.id, 
                li.titulo, 
                au.nombre, 
                ed.nombre, 
                li.fecha_edicion, 
                li.generos_id, 
                li.stock, 
                li.precio
            ) LIKE :expresion
        GROUP BY 
            li.id
        ORDER BY 
            li.id ASC";


            $conexion = $this->db->connect();

            $stmt = $conexion->prepare($sql);


            // Expresión para el operador LIKE usando % para que lea tanto lo que hay detrás como delante de la misma expresión
            $expresion = '%' . $expresion . '%';


            $stmt->bindParam(':expresion', $expresion, PDO::PARAM_STR, 255);


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
}
