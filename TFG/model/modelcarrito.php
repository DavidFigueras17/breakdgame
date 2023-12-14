<?php


// Verificar si se recibió el array juegoscarrito
if (isset($_GET['juegoscarrito'])) {
    // Obtener el array enviado desde JavaScript
    $arrayJuegosCarrito = $_GET['juegoscarrito'];

    // Acceder a los elementos del array
    $idJuego = $arrayJuegosCarrito[0];
    $cantidadSeleccionada = $arrayJuegosCarrito[1];
    $idcarrito = $arrayJuegosCarrito[2];

    $servername = "localhost";
    $username = "root"; // Nombre de usuario de la base de datos
    $password = ""; // Contraseña de la base de datos
    $dbname = "breakdgame";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta SQL
    $sql1 = "SELECT * FROM carrito WHERE Idvideojuego = $idJuego";

    $resultado = $conn->query($sql1);
    
    if ($resultado->num_rows > 0) {
        // El ID ya existe en la tabla
        $sql = "UPDATE carrito SET Cantidad=$cantidadSeleccionada WHERE Idvideojuego=$idJuego";
        $conn->query($sql);
    } else {
        // El ID no existe en la tabla
        $sql = "INSERT INTO carrito(idcarrito, Idvideojuego, Cantidad) VALUES ($idcarrito, $idJuego,$cantidadSeleccionada)";
        $conn->query($sql);
    }

   

    
    
}
?>