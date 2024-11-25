<?php

/*
    clase: class.tabla_clientes.php
    descripcion: define la clase que va a contener el array de objetos de la clase clientes.
*/

class Class_tabla_clientes extends Class_conexion
{


    /*
        método: getClientes()
        descripcion: devuelve un objeto de la clase mysqli_result con los 
        detalles de los clientes
    */

    public function getClientes()
    {
        $sql = "
            select 
                id,
                nombre, 
                apellidos,
                email,
                telefono,
                ciudad,
                dni
            from 
                gesbank.clientes 
        ";

        // ejecuto comando sql
        $result = $this->db->query($sql);

        // obtengo un objeto de la clase mysqli_result
        // devuelvo dicho objeto
        return $result;


    }


    /*
        método: create()
        descripcion: permite añadir un objeto de la clase cliente a la tabla
        
        parámetros:

            - $cliente - objeto de la clase cliente

    */
    public function create(Class_cliente $cliente)
    {
        // Crear la sentencia preparada
        $sql = "
        INSERT INTO 
            clientes( 
                    apellidos,
                    nombre,
                    telefono,
                    ciudad,
                    dni,
                    email
                   )
        VALUES    (?, ?, ?, ?, ?, ?)                            
        ";

        // ejecuto la sentenecia preprada
        $stmt = $this->db->prepare($sql);

        // verifico
        if (!$stmt) {
            die("Error al preparar sql " . $this->db->error);
        }

        // vinculación de parámetros
        $stmt->bind_param(
            'ssisss',
            $apellidos,
            $nombre,
            $telefono,
            $ciudad,
            $dni,
            $email,
        );

        // asignar valores
        $nombre = $cliente->nombre;
        $apellidos = $cliente->apellidos;
        $email = $cliente->email;
        $telefono = $cliente->telefono;
        $ciudad = $cliente->ciudad;    
        $dni = $cliente->dni;

        // ejecutamos
        $stmt->execute();

    }

    /*
        método: read()
        descripcion: permite obtener el objeto de la clase libro a partir de un índice 
        de la tabla

        parámetros:

            - $indice - índice de la tabla
    */
    public function read($indice)
    {
        return $this->tabla[$indice];
    }

    /*
        método: update()
        descripcion: permite actualizar los detalles de un libro en la tabla

        parámetros:

            - $libro - objeto de la clase libro, con los detalles actualizados de dicho artículo
            - $indice - índice de la tabla
    */
    public function update(Class_libro $libro, $indice)
    {
        $this->tabla[$indice] = $libro;
    }


    /*
        método: delete()
        descripcion: permite eliminar un libro de la tabla

        parámetros:

            - $indice - índice de la tabla en la que se encuentra el libro
    */
    public function delete($indice)
    {
        unset($this->tabla[$indice]);
    }

    /*
        getCursos()

        Método que me devuelve todos los cursos en un array assoc de cursos
    */

    public function getCursos() {
        $sql = "
            SELECT 
                    id, 
                    nombreCorto as curso
            FROM 
                    cursos
            ORDER BY
                    nombreCorto ASC
        ";

        $result = $this->db->query($sql);

        // devuelvo todos los valores de la  tabla cursos
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
