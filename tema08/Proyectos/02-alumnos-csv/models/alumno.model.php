<?php

/*
    alumnoModel.php

    Modelo del controlador alumno

    Métodos:

        - get()
*/

class alumnoModel extends Model
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
                alumnos.id,
                CONCAT_WS(', ', alumnos.apellidos, alumnos.nombre) as alumno,
                alumnos.email,
                alumnos.telefono,
                alumnos.nacionalidad,
                alumnos.dni,
                timestampdiff(YEAR, alumnos.fechaNac, now()) as edad,
                cursos.nombreCorto as curso
            FROM 
                alumnos 
            INNER JOIN
                cursos
            ON alumnos.id_curso = cursos.id
            ORDER BY alumnos.id";

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
       método: get_cursos()

       Extre los detalles de los cursos para generar lista desplegable 
       dinámica
   */
    public function get_cursos()
    {

        try {

            // sentencia sql
            $sql = "SELECT 
                        id,
                        nombre as curso
                    FROM 
                        cursos
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
        método: create

        descripción: añade nuevo alumno
        parámetros: objeto de classAlumno
    */

    public function create(classAlumno $alumno)
    {

        try {
            $sql = "INSERT INTO Alumnos (
                    nombre,
                    apellidos,
                    email,
                    telefono,
                    nacionalidad,
                    dni,
                    fechaNac,
                    id_curso
                )
                VALUES (
                    :nombre,
                    :apellidos,
                    :email,
                    :telefono,
                    :nacionalidad,
                    :dni,
                    :fechaNac,
                    :id_curso
                )
            ";
            # Conectar con la base de datos
            $conexion = $this->db->connect();


            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(':nombre', $alumno->nombre, PDO::PARAM_STR, 30);
            $stmt->bindParam(':apellidos', $alumno->apellidos, PDO::PARAM_STR, 50);
            $stmt->bindParam(':email', $alumno->email, PDO::PARAM_STR, 50);
            $stmt->bindParam(':telefono', $alumno->telefono, PDO::PARAM_STR, 13);
            $stmt->bindParam(':nacionalidad', $alumno->nacionalidad, PDO::PARAM_STR, 30);
            $stmt->bindParam(':dni', $alumno->dni, PDO::PARAM_STR, 9);
            $stmt->bindParam(':fechaNac', $alumno->fechaNac, PDO::PARAM_STR);
            $stmt->bindParam(':id_curso', $alumno->id_curso, PDO::PARAM_INT);


            // añado alumno
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
                            apellidos,
                            email,
                            telefono,
                            nacionalidad,
                            dni,
                            fechaNac,
                            id_curso
                    FROM 
                            alumnos
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

    public function update(classAlumno $alumno, $id)
    {

        try {

            $sql = "
            
            UPDATE alumnos
            SET
                    nombre = :nombre,
                    apellidos = :apellidos,
                    email = :email,
                    telefono = :telefono,
                    nacionalidad = :nacionalidad,
                    dni = :dni,
                    fechaNac = :fechaNac,
                    id_curso = :id_curso
            WHERE
                    id = :id
            LIMIT 1
            ";

            $conexion = $this->db->connect();

            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->bindParam(':nombre', $alumno->nombre, PDO::PARAM_STR, 30);
            $stmt->bindParam(':apellidos', $alumno->apellidos, PDO::PARAM_STR, 50);
            $stmt->bindParam(':email', $alumno->email, PDO::PARAM_STR, 50);
            $stmt->bindParam(':telefono', $alumno->telefono, PDO::PARAM_STR, 9);
            $stmt->bindParam(':nacionalidad', $alumno->nacionalidad, PDO::PARAM_STR, 30);
            $stmt->bindParam(':dni', $alumno->dni, PDO::PARAM_STR, 9);
            $stmt->bindParam(':fechaNac', $alumno->fechaNac, PDO::PARAM_STR);
            $stmt->bindParam(':id_curso', $alumno->id_curso, PDO::PARAM_INT);

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
                DELETE FROM alumnos
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
                alumnos.id,
                concat_ws(', ', alumnos.apellidos, alumnos.nombre) alumno,
                alumnos.email,
                alumnos.telefono,
                alumnos.nacionalidad,
                alumnos.dni,
                timestampdiff(YEAR,  alumnos.fechaNac, NOW() ) edad,
                cursos.nombreCorto curso
            FROM
                alumnos
            INNER JOIN
                cursos
            ON 
                alumnos.id_curso = cursos.id
            WHERE

                CONCAT_WS(  ', ', 
                            alumnos.id,
                            alumnos.nombre,
                            alumnos.apellidos,
                            alumnos.email,
                            alumnos.telefono,
                            alumnos.poblacion,
                            alumnos.nacionalidad,
                            alumnos.dni,
                            TIMESTAMPDIFF(YEAR, alumnos.fechaNac, now()),
                            alumnos.fechaNac,
                            cursos.nombreCorto,
                            cursos.nombre) 
                like :expresion

            ORDER BY 
                alumnos.id
            
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
    public function order(int $criterio) {

        try {

            # comando sql
            $sql = "
            SELECT 
                alumnos.id,
                concat_ws(', ', alumnos.apellidos, alumnos.nombre) alumno,
                alumnos.email,
                alumnos.telefono,
                alumnos.nacionalidad,
                alumnos.dni,
                cursos.nombreCorto curso,
                timestampdiff(YEAR,  alumnos.fechaNac, NOW() ) edad 
            FROM
                alumnos
            INNER JOIN
                cursos
            ON 
                alumnos.id_curso = cursos.id
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

    /*
        método: get()

        Extre los detalles de la tabla alumnos
    */
    public function get_csv()
    {

        try {

            // sentencia sql
            $sql = "SELECT 
                alumnos.id,
                CONCAT_WS(', ', alumnos.apellidos, alumnos.nombre) as alumno,
                alumnos.email,
                alumnos.telefono,
                alumnos.nacionalidad,
                alumnos.dni,
                timestampdiff(YEAR, alumnos.fechaNac, now()) as edad,
                cursos.nombreCorto as curso
            FROM 
                alumnos 
            INNER JOIN
                cursos
            ON alumnos.id_curso = cursos.id
            ORDER BY alumnos.id";

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

            - $alumnos array con los datos del fichero csv

    */
    public function import($alumnos) {

        try {

            $sql = "INSERT INTO Alumnos (
                    nombre,
                    apellidos,
                    email,
                    telefono,
                    nacionalidad,
                    dni,
                    fechaNac,
                    id_curso
                )
                VALUES (
                    :nombre,
                    :apellidos,
                    :email,
                    :telefono,
                    :nacionalidad,
                    :dni,
                    :fechaNac,
                    :id_curso
                )
            ";
            # Conectar con la base de datos
            $conexion = $this->db->connect();

            $stmt = $conexion->prepare($sql);

            foreach ($alumnos as $alumno) {

                $stmt->bindParam(':nombre', $alumno[0], PDO::PARAM_STR, 30);
                $stmt->bindParam(':apellidos', $alumno[1], PDO::PARAM_STR, 50);
                $stmt->bindParam(':email', $alumno[2], PDO::PARAM_STR, 50);
                $stmt->bindParam(':telefono', $alumno[3], PDO::PARAM_STR, 13);
                $stmt->bindParam(':nacionalidad', $alumno[4], PDO::PARAM_STR, 30);
                $stmt->bindParam(':dni', $alumno[5], PDO::PARAM_STR, 9);
                $stmt->bindParam(':fechaNac', $alumno[6], PDO::PARAM_STR);
                $stmt->bindParam(':id_curso', $alumno[7], PDO::PARAM_INT);

                // añado alumno
                $stmt->execute();
            }

            // devuelvo el número de alumnos importados
            return count($alumnos);

        } catch (PDOException $e) {
            // error base de datos
            require_once 'template/partials/errorDB.partial.php';
            $stmt = null;
            $conexion = null;
            $this->db = null;
        }
    }


}
