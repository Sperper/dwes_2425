<?php

/*
    clase: class.tabla_libros.php
    descripcion: define la clase que va a contener el array de objetos de la clase libro.
*/



class Class_tabla_libros extends Class_conexion
{


    /*
        método: getLibros()
        descripcion: devuelve un objeto pdostatement con los detalles de los libros
    */

    public function get_libros()
    {
        try {

            $sql = "SELECT 
                        libros.id,
                        libros.titulo,
                        autores.nombre as autor,
                        editoriales.nombre as editorial,
                        libros.generos_id,
                        libros.precio,
                        libros.stock
                    FROM 
                        libros
                    INNER JOIN 
                        autores ON libros.autor_id = autores.id
                    INNER JOIN 
                        editoriales ON libros.editorial_id = editoriales.id
                    ORDER BY libros.id";

            $stmt = $this->pdo->prepare($sql);

            $stmt->setFetchMode(PDO::FETCH_OBJ);

            $stmt->execute();

            return $stmt;
        } catch (PDOException $e) {

            include "views/partials/errorDB.php";

            $stmt = null;

            $this->pdo = null;

            exit();
        }
    }

    /*
        método: get_generos()
        descripcion: devuelve un array clave valor con la tabla géneros
    */


    public function get_generos()
    {
        try {

            $sql = "SELECT 
                        id,
                        tema
                    FROM 
                        generos
                    ORDER BY tema ASC";

            $stmt = $this->pdo->prepare($sql);

            $stmt->setFetchMode(PDO::FETCH_KEY_PAIR);

            $stmt->execute();

            return $stmt;
        } catch (PDOException $e) {

            include "views/partials/errorDB.php";

            $stmt = null;

            $this->pdo = null;

            exit();
        }
    }





    /*
        método: get_generos_asociados()
        descripcion: devuelve un array con los géneros asociados a un libro

        Parámetros:
        - $generos_id - lista indice de géneros asociados a un libro
    */

    public function get_generos_asociados($generos_id)
    {
        try {

            $generos = $this->get_generos();

            $generos_nominativos = [];

            foreach ($generos_id as $genero) {
                foreach ($generos as $id => $nombre_genero) {
                    if ($id == $genero) {
                        array_push($generos_nominativos, $nombre_genero);
                    }
                }
            }

            return $generos_nominativos;
        } catch (PDOException $e) {

            include "views/partials/errorDB.php";

            $stmt = null;

            $this->pdo = null;

            exit();
        }
    }

    /*
        método: get_autores()
        descripcion: devuelve un pdostatement par clave valor
    */

    public function get_autores()
    {
        try {

            $sql = "SELECT  
                        id,
                        nombre
                    FROM 
                        autores
                    ORDER BY nombre ASC";

            $stmt = $this->pdo->prepare($sql);

            $stmt->setFetchMode(PDO::FETCH_KEY_PAIR);

            $stmt->execute();

            return $stmt;
        } catch (PDOException $e) {

            include "views/partials/errorDB.php";

            $stmt = null;

            $this->pdo = null;

            exit();
        }
    }

    /*
        método: get_editoriales()
        descripcion: devuelve un pdostatement par clave valor
    */

    public function get_editoriales()
    {
        try {

            $sql = "SELECT  
                        id,
                        nombre
                    FROM 
                        editoriales
                    ORDER BY nombre ASC";

            $stmt = $this->pdo->prepare($sql);

            $stmt->setFetchMode(PDO::FETCH_KEY_PAIR);

            $stmt->execute();

            return $stmt;
        } catch (PDOException $e) {

            include "views/partials/errorDB.php";

            $stmt = null;

            $this->pdo = null;

            exit();
        }
    }

    /*
        método: create()
        descripcion: permite añadir un nuevo libro a la tabla
        
        parámetros:

            - $libro - objeto de la clase libro

    */
    public function create(Class_libro $libro)
    {
        try {

            $sql = "INSERT INTO 
                libros (titulo, 
                precio, 
                stock, 
                fecha_edicion, 
                isbn, 
                autor_id, 
                editorial_id, 
                generos_id) 
                VALUES (:titulo, 
                :precio, 
                :stock, 
                :fecha_edicion, 
                :isbn, 
                :autor_id, 
                :editorial_id, 
                :generos_id
                )";

            $stmt = $this->pdo->prepare($sql);

            $stmt->bindParam('titulo', $libro->titulo, PDO::PARAM_STR);
            $stmt->bindParam(':precio', $libro->precio, PDO::PARAM_STR);
            $stmt->bindParam(':stock', $libro->stock, PDO::PARAM_INT);
            $stmt->bindParam(':fecha_edicion', $libro->fecha_edicion, PDO::PARAM_STR);
            $stmt->bindParam(':isbn', $libro->isbn, PDO::PARAM_STR);
            $stmt->bindParam(':autor_id', $libro->autor_id, PDO::PARAM_INT);
            $stmt->bindParam(':editorial_id', $libro->editorial_id, type: PDO::PARAM_INT);
            $stmt->bindParam(':generos_id', $libro->stock, PDO::PARAM_STR);

            $stmt->execute();


        } catch (PDOException $e) {

            include "views/partials/errorDB.php";

            $stmt = null;

            $this->pdo = null;

            exit();
        }
    }



    /*
        método: order()
        descripcion: devuelve un objeto de la clase pdostatement con los 
        detalles de los libros  ordenados por un criterio.

        Parámetros:

            - criterio: posición de la columna en la tabla libros
                        por la que quiero ordenar
    */

    public function order(int $criterio)
    {
        try {

            $sql = "SELECT 
                        libros.id,
                        libros.titulo,
                        autores.nombre as autor,
                        editoriales.nombre as editorial,
                        libros.generos_id,
                        libros.precio,
                        libros.stock
                    FROM 
                        libros
                    INNER JOIN 
                        autores ON libros.autor_id = autores.id
                    INNER JOIN 
                        editoriales ON libros.editorial_id = editoriales.id
                    ORDER BY
                        :criterio";

            $stmt = $this->pdo->prepare($sql);

            $stmt->bindParam(':criterio', $criterio, PDO::PARAM_INT);

            $stmt->setFetchMode(PDO::FETCH_OBJ);

            $stmt->execute();

            return $stmt;

        } catch (PDOException $e) {

            include "views/partials/errorDB.php";

            $stmt = null;

            $this->pdo = null;

            exit();
        }
    }
}
