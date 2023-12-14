<?php

class Cliente
{
    private $conexion;
    private $idUsuario;
    private $nombre;
    private $apellido;
    private $correo;
    private $direccion;
    private $fechaNacimiento;
    private $admin;
    private $password;

    // Constructor
    public function __construct($conexion, $idUsuario, $nombre, $apellido, $correo, $direccion, $fechaNacimiento, $admin, $password)
    {
        $this->conexion = $conexion;
        $this->idUsuario = $idUsuario;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->correo = $correo;
        $this->direccion = $direccion;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->admin = $admin;
        $this->password = $password;
    }

    // Métodos de la clase 
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    public function getAdmin()
    {
        return $this->admin;
    }

    public function getPassword()
    {
        return $this->password;
    }

    // Puedes agregar más métodos según sea necesario
}



class ClienteDAO
{
    private $conexion;

    // Constructor
    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function obtenerClienteComentario()
    {
        $listaClientes = array();

        // Ejemplo de consulta SQL para obtener un cliente por ID
        $sql = "SELECT DISTINCT  c.* FROM cliente c INNER JOIN opinion o ON c.Idusuario = o.Idusuario";
        $resultado = $this->conexion->query($sql);

        if ($resultado) {
            // Obtener el resultado y crear un objeto Cliente
            while ($fila = $resultado->fetch_assoc()) {
                $cliente = new Cliente(
                    $this->conexion,
                    $fila['Idusuario'],
                    $fila['Nombre'],
                    $fila['Apellido'],
                    $fila['Correo'],
                    $fila['Direccion'],
                    $fila['Fechanacimiento'],
                    $fila['admin'],
                    $fila['password']
                );
                $listaClientes[] = $cliente;
            }

            // Liberar el resultado
            $resultado->free();
        } else {
            // Manejar el error de la consulta
            echo "Error en la consulta: " . $this->conexion->error;
        }

        return $listaClientes;
    }

    public function obtenerCliente($id)
    {
        $sql = "SELECT * FROM cliente WHERE Idusuario = $id";
        $resultado = $this->conexion->query($sql);

        if ($resultado) {
            // Verificar si se encontró un cliente
            if ($resultado->num_rows > 0) {
                // Obtener el primer resultado y crear un objeto Cliente
                $fila = $resultado->fetch_assoc();
                $cliente = new Cliente(
                    $this->conexion,
                    $fila['Idusuario'],
                    $fila['Nombre'],
                    $fila['Apellido'],
                    $fila['Correo'],
                    $fila['Direccion'],
                    $fila['Fechanacimiento'],
                    $fila['admin'],
                    $fila['password']
                );

                // Liberar el resultado
                $resultado->free();

                return $cliente;
            } else {

                echo "No se encontró ningún cliente con ID $id";
            }
        } else {

            echo "Error en la consulta: " . $this->conexion->error;
        }


        return null;
    }
    public function obtenerClientetodos()
    {
        $listaClientes = array();

        // Ejemplo de consulta SQL para obtener un cliente por ID
        $sql = "SELECT * FROM cliente";
        $resultado = $this->conexion->query($sql);

        if ($resultado) {
            // Obtener el resultado y crear un objeto Cliente
            while ($fila = $resultado->fetch_assoc()) {
                $cliente = new Cliente(
                    $this->conexion,
                    $fila['Idusuario'],
                    $fila['Nombre'],
                    $fila['Apellido'],
                    $fila['Correo'],
                    $fila['Direccion'],
                    $fila['Fechanacimiento'],
                    $fila['admin'],
                    $fila['password']
                );
                $listaClientes[] = $cliente;
            }

            // Liberar el resultado
            $resultado->free();
        } else {
            // Manejar el error de la consulta
            echo "Error en la consulta: " . $this->conexion->error;
        }

        return $listaClientes;
    }
}


$clienteDAO = new ClienteDAO($mysqli);
