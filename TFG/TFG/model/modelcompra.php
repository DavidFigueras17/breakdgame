<?php
class Compra {
    private $conexion;
    private $idcompra;
    private $idUsuario;
    private $idVideojuego;
    private $fecha;
    private $cantidad;

    // Constructor
    public function __construct($conexion, $idcompra, $idUsuario, $idVideojuego, $fecha, $cantidad )
    {
        $this->conexion = $conexion;
        $this->idcompra = $idcompra;
        $this->idUsuario = $idUsuario;
        $this->idVideojuego = $idVideojuego;
        $this->fecha = $fecha;
        $this->cantidad = $cantidad;
    }

    // Métodos de la clase 
    public function getIdcompra()
    {
        return $this->idcompra;
    }

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function getIdVideojuego()
    {
        return $this->idVideojuego;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    
}
class CompraDAO {
    private $conexion;

    // Constructor
    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function obtenerComprasporpersona($idUsuario)
    {
        $listaCompras = array();

        // Ejemplo de consulta SQL para obtener opiniones
        $sql = "SELECT  * FROM compra WHERE Idcliente= $idUsuario ";
        $resultado = $this->conexion->query($sql);

        if ($resultado) {
            // Recorrer los resultados y rellenar objetos Opinion
            while ($fila = $resultado->fetch_assoc()) {
                $compras = new Compra(
                    $this->conexion,
                    $fila['Idcompra'],
                    $fila['Idcliente'],
                    $fila['Idvideojuego'],
                    $fila['Fecha'],
                    $fila['cantidad']
                );

                // Agregar la opinión a la lista
                $listaCompras[] = $compras;
            }

            // Liberar el resultado
            $resultado->free();
        } else {
            // Manejar el error de la consulta
            echo "Error en la consulta: " . $this->conexion->error;
        }

        return $listaCompras;
      }
  }
  $compraDAO = new CompraDAO($mysqli);
?>