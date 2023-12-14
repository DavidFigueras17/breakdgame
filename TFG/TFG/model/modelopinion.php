<?php
class Opinion {
    private $conexion;
    private $idOpinion;
    private $idUsuario;
    private $idVideojuego;
    private $comentario;
    private $puntuacion;

    // Constructor
    public function __construct($conexion, $idOpinion, $idUsuario, $idVideojuego, $comentario, $puntuacion)
    {
        $this->conexion = $conexion;
        $this->idOpinion = $idOpinion;
        $this->idUsuario = $idUsuario;
        $this->idVideojuego = $idVideojuego;
        $this->comentario = $comentario;
        $this->puntuacion = $puntuacion;
    }

    // Métodos de la clase 
    public function getIdOpinion()
    {
        return $this->idOpinion;
    }

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function getIdVideojuego()
    {
        return $this->idVideojuego;
    }

    public function getComentario()
    {
        return $this->comentario;
    }

    public function getPuntuacion()
    {
        return $this->puntuacion;
    }

    // Puedes agregar más métodos según sea necesario
}


class OpinionDAO {
    private $conexion;

    // Constructor
    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function obtenerOpinionesPorVideojuego($idVideojuego, $idUsuario)
    {
        $listaOpiniones = array();

        // Ejemplo de consulta SQL para obtener opiniones
        $sql = "SELECT  * FROM opinion WHERE Idvideojuego = $idVideojuego and Idusuario= $idUsuario ";
        $resultado = $this->conexion->query($sql);

        if ($resultado) {
            // Recorrer los resultados y rellenar objetos Opinion
            while ($fila = $resultado->fetch_assoc()) {
                $opinion = new Opinion(
                    $this->conexion,
                    $fila['Idopinion'],
                    $fila['Idusuario'],
                    $fila['Idvideojuego'],
                    $fila['Comentario'],
                    $fila['Puntuacion']
                );

                // Agregar la opinión a la lista
                $listaOpiniones[] = $opinion;
            }

            // Liberar el resultado
            $resultado->free();
        } else {
            // Manejar el error de la consulta
            echo "Error en la consulta: " . $this->conexion->error;
        }

        return $listaOpiniones;
    }

    public function obtenerOpiniones($idVideojuego)
    {
        $listaOpiniones = array();

        // Ejemplo de consulta SQL para obtener opiniones
        $sql = "SELECT * FROM opinion WHERE Idvideojuego = $idVideojuego";
        $resultado = $this->conexion->query($sql);

        if ($resultado) {
            // Recorrer los resultados y rellenar objetos Opinion
            while ($fila = $resultado->fetch_assoc()) {
                $opinion = new Opinion(
                    $this->conexion,
                    $fila['Idopinion'],
                    $fila['Idusuario'],
                    $fila['Idvideojuego'],
                    $fila['Comentario'],
                    $fila['Puntuacion']
                );

                // Agregar la opinión a la lista
                $listaOpiniones[] = $opinion;
            }

            // Liberar el resultado
            $resultado->free();
        } else {
            // Manejar el error de la consulta
            echo "Error en la consulta: " . $this->conexion->error;
        }

        return $listaOpiniones;
    }


    
}

$opinionDAO = new OpinionDAO($mysqli);
?>