<?php





class Videojuego
{
    private $conexion;
    private $idvideojuego;
    private $titulo;
    private $genero;
    private $plataforma;
    private $precio;
    private $stock;
    private $sinopsis;
    private $imagen;
    private $puntuacion;

    // Constructor
    public function __construct($conexion, $idvideojuego, $titulo, $genero, $plataforma, $precio, $stock, $sinopsis, $imagen, $puntuacion)
    {
        $this->conexion = $conexion;
        $this->idvideojuego = $idvideojuego;
        $this->titulo = $titulo;
        $this->genero = $genero;
        $this->plataforma = $plataforma;
        $this->precio = $precio;
        $this->stock = $stock;
        $this->sinopsis = $sinopsis;
        $this->imagen = $imagen;
        $this->puntuacion = $puntuacion;
    }

    // Métodos de la clase 
    public function getIdVideojuego()
    {
        return $this->idvideojuego;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getGenero()
    {
        return $this->genero;
    }

    public function getPlataforma()
    {
        return $this->plataforma;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function getSinopsis()
    {
        return $this->sinopsis;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function getPuntuacion()
    {
        return $this->puntuacion;
    }

    public function obtenerVideojuegos()
    {
        $listaVideojuegos = array();

        // Ejemplo de consulta SQL para obtener videojuegos
        $limite = isset($_GET['aumentarLimite']) ? intval($_GET['aumentarLimite']) : 16;
        $sql = "SELECT * FROM videojuegos limit $limite";
        $resultado = $this->conexion->query($sql);

        if ($resultado) {
            // Recorrer los resultados y rellenar objetos Videojuego
            while ($fila = $resultado->fetch_assoc()) {
                $videojuego = new Videojuego(
                    $this->conexion,
                    $fila['Idvideojuego'],
                    $fila['Titulo'],
                    $fila['Genero'],
                    $fila['Plataforma'],
                    $fila['Precio'],
                    $fila['Stock'],
                    $fila['Sinopsis'],
                    $fila['Imagen'],
                    $fila['Puntuacion']
                );

                // Agregar el videojuego a la lista
                $listaVideojuegos[] = $videojuego;
            }

            // Liberar el resultado
            $resultado->free();
        } else {
            // Manejar el error de la consulta
            echo "Error en la consulta: " . $this->conexion->error;
        }

        return $listaVideojuegos;
    }

    public function obtenerVideojuegosPlataforma()
    {
        $listaVideojuegos = array();

        // Ejemplo de consulta SQL para obtener videojuegos

        if (isset($_GET['platform'])) {
            $platform = $_GET['platform'];
        } else {
            // Maneja el caso en el que no se proporcionó un ID en la URL.
            echo "platform no especificado.";
        }

        $limite = isset($_GET['aumentarLimite']) ? intval($_GET['aumentarLimite']) : 16;
        $sql = "SELECT * FROM videojuegos where Plataforma='$platform' OR Plataforma='Todas' limit $limite";
        $resultado = $this->conexion->query($sql);

        if ($resultado) {
            // Recorrer los resultados y rellenar objetos Videojuego
            while ($fila = $resultado->fetch_assoc()) {
                $videojuego = new Videojuego(
                    $this->conexion,
                    $fila['Idvideojuego'],
                    $fila['Titulo'],
                    $fila['Genero'],
                    $fila['Plataforma'],
                    $fila['Precio'],
                    $fila['Stock'],
                    $fila['Sinopsis'],
                    $fila['Imagen'],
                    $fila['Puntuacion']
                );

                // Agregar el videojuego a la lista
                $listaVideojuegos[] = $videojuego;
            }

            // Liberar el resultado
            $resultado->free();
        } else {
            // Manejar el error de la consulta
            echo "Error en la consulta: " . $this->conexion->error;
        }

        return $listaVideojuegos;
    }

    public function obtenerVideojuegosId()
    {
        $listaVideojuegos = array();

        // Ejemplo de consulta SQL para obtener videojuegos
        if (isset($_GET['id'])) {
            $juegoID = $_GET['id'];
        } else {
            // Maneja el caso en el que no se proporcionó un ID en la URL.
            echo "ID de juego no especificado.";
        }
        $sql = "SELECT * FROM videojuegos where Idvideojuego=$juegoID";
        $resultado = $this->conexion->query($sql);

        if ($resultado) {
            // Recorrer los resultados y rellenar objetos Videojuego
            while ($fila = $resultado->fetch_assoc()) {
                $videojuego = new Videojuego(
                    $this->conexion,
                    $fila['Idvideojuego'],
                    $fila['Titulo'],
                    $fila['Genero'],
                    $fila['Plataforma'],
                    $fila['Precio'],
                    $fila['Stock'],
                    $fila['Sinopsis'],
                    $fila['Imagen'],
                    $fila['Puntuacion']
                );

                // Agregar el videojuego a la lista
                $listaVideojuegos[] = $videojuego;
            }

            // Liberar el resultado
            $resultado->free();
        } else {
            // Manejar el error de la consulta
            echo "Error en la consulta: " . $this->conexion->error;
        }

        return $listaVideojuegos;
    }
    public function obtenerVideojuegosIdAdmin($juegoID)
    {
        $listaVideojuegos = array();

        // Ejemplo de consulta SQL para obtener videojuegos
      
        $sql = "SELECT * FROM videojuegos where Idvideojuego=$juegoID";
        $resultado = $this->conexion->query($sql);

        if ($resultado) {
            // Recorrer los resultados y rellenar objetos Videojuego
            while ($fila = $resultado->fetch_assoc()) {
                $videojuego = new Videojuego(
                    $this->conexion,
                    $fila['Idvideojuego'],
                    $fila['Titulo'],
                    $fila['Genero'],
                    $fila['Plataforma'],
                    $fila['Precio'],
                    $fila['Stock'],
                    $fila['Sinopsis'],
                    $fila['Imagen'],
                    $fila['Puntuacion']
                );

                // Agregar el videojuego a la lista
                $listaVideojuegos[] = $videojuego;
            }

            // Liberar el resultado
            $resultado->free();
        } else {
            // Manejar el error de la consulta
            echo "Error en la consulta: " . $this->conexion->error;
        }

        return $listaVideojuegos;
    }

    public function obtenerVideojuegosCarro()
    {
        $listaVideojuegos = array();

        // Ejemplo de consulta SQL para obtener videojuegos
        if (isset($_GET['id0'])) {
            $idjuego1 = $_GET['id0'];

            // Verifica si hay más parámetros y recógelos
            $i = 1;
            $idjuegos = array($idjuego1);

            while (isset($_GET['id' . $i])) {
                $idjuego = $_GET['id' . $i];
                $idjuegos[] = $idjuego;
                $i++;
            }

            // Construye la parte IN de la consulta SQL
            $inClause = implode(',', $idjuegos);

            // Construye y ejecuta la consulta SQL
            $sql = "SELECT * FROM videojuegos WHERE Idvideojuego IN ($inClause)";
            // Aquí debes ejecutar la consulta en tu entorno específico (por ejemplo, utilizando MySQLi o PDO)
        } else {
            echo 'No se proporcionaron idjuegos.';
        }
       
        $resultado = $this->conexion->query($sql);

        if ($resultado) {
            // Recorrer los resultados y rellenar objetos Videojuego
            while ($fila = $resultado->fetch_assoc()) {
                $videojuego = new Videojuego(
                    $this->conexion,
                    $fila['Idvideojuego'],
                    $fila['Titulo'],
                    $fila['Genero'],
                    $fila['Plataforma'],
                    $fila['Precio'],
                    $fila['Stock'],
                    $fila['Sinopsis'],
                    $fila['Imagen'],
                    $fila['Puntuacion']
                );

                // Agregar el videojuego a la lista
                $listaVideojuegos[] = $videojuego;
            }

            // Liberar el resultado
            $resultado->free();
        } else {
            // Manejar el error de la consulta
            echo "Error en la consulta: " . $this->conexion->error;
        }

        return $listaVideojuegos;
    }

    public function obtenerVideojuegostitulo()
    {
        $listaVideojuegos = array();

        // Ejemplo de consulta SQL para obtener videojuegos
        if (isset($_GET['titulo'])) {
            $juegotitulo = $_GET['titulo'];
        } else {
            // Maneja el caso en el que no se proporcionó un ID en la URL.
            echo "ID de juego no especificado.";
        }
        $sql = "SELECT * FROM videojuegos where Titulo=$juegotitulo";
        $resultado = $this->conexion->query($sql);

        if ($resultado) {
            // Recorrer los resultados y rellenar objetos Videojuego
            while ($fila = $resultado->fetch_assoc()) {
                $videojuego = new Videojuego(
                    $this->conexion,
                    $fila['Idvideojuego'],
                    $fila['Titulo'],
                    $fila['Genero'],
                    $fila['Plataforma'],
                    $fila['Precio'],
                    $fila['Stock'],
                    $fila['Sinopsis'],
                    $fila['Imagen'],
                    $fila['Puntuacion']
                );

                // Agregar el videojuego a la lista
                $listaVideojuegos[] = $videojuego;
            }

            // Liberar el resultado
            $resultado->free();
        } else {
            // Manejar el error de la consulta
            echo "Error en la consulta: " . $this->conexion->error;
        }

        return $listaVideojuegos;
    }

    public function obtenerVideojuegosadmin()
    {
        $listaVideojuegos = array();

        // Ejemplo de consulta SQL para obtener videojuegos

        $sql = "SELECT * FROM videojuegos ";
        $resultado = $this->conexion->query($sql);

        if ($resultado) {
            // Recorrer los resultados y rellenar objetos Videojuego
            while ($fila = $resultado->fetch_assoc()) {
                $videojuego = new Videojuego(
                    $this->conexion,
                    $fila['Idvideojuego'],
                    $fila['Titulo'],
                    $fila['Genero'],
                    $fila['Plataforma'],
                    $fila['Precio'],
                    $fila['Stock'],
                    $fila['Sinopsis'],
                    $fila['Imagen'],
                    $fila['Puntuacion']
                );

                // Agregar el videojuego a la lista
                $listaVideojuegos[] = $videojuego;
            }

            // Liberar el resultado
            $resultado->free();
        } else {
            // Manejar el error de la consulta
            echo "Error en la consulta: " . $this->conexion->error;
        }

        return $listaVideojuegos;
    }
    
}




// Uso del VideojuegoDAO
//$mysqli = new mysqli("localhost", "id21544442_david", "Sicparvismagna-17", "id21544442_breakdgame");
$mysqli = new mysqli("localhost", "u528235005_david", "Sicparvismagna17", "u528235005_breakdgame");
if ($mysqli->connect_error) {
    die("Error de conexión a la base de datos: " . $mysqli->connect_error);
}


$videojuegoDAO = new Videojuego($mysqli, 0, "", "", "", 0, 0, "", "", 0);
