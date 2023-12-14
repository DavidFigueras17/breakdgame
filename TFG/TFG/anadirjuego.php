<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $titulo = $_POST['tituloa'];
    $genero = $_POST['generoa'];
    $plataforma = $_POST['plataformaa'];
    $precio = $_POST['precioa'];
    $stock = $_POST['stocka'];
    $puntuacion = $_POST['puntuaciona'];
    $sinopsis = $_POST['sinopsisa'];
    $imagen = $_POST['imagena'];

    $mysqli = new mysqli("localhost", "id21544442_david", "Sicparvismagna-17", "id21544442_breakdgame");
    if ($mysqli->connect_error) {
        die("Error de conexión: " . $mysqli->connect_error);
    }

    // Cambié $sql a $query para que coincida con el nombre de la variable que estás utilizando
    $insertQuery = "INSERT INTO `videojuegos` (`Titulo`, `Genero`, `Plataforma`, `Precio`, `Stock`, `Sinopsis`, `Imagen`, `Puntuacion`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmtInsert = $mysqli->prepare($insertQuery);
    $stmtInsert->bind_param("sssiissi", $titulo, $genero, $plataforma, $precio, $stock, $sinopsis, $imagen, $puntuacion);

    // Verificar si la preparación fue exitosa
    if ($stmtInsert === false) {
        die("Error en la preparación de la consulta de inserción: " . $mysqli->error);
    }

    // Ejecutar la consulta de inserción
    $stmtInsert->execute();

    // Verificar si la ejecución fue exitosa
    if ($stmtInsert->affected_rows > 0) {
        echo "Inserción exitosa";
    } else {
        echo "No se realizó ninguna inserción";
    }

    // Cerrar la conexión y liberar los recursos
    $stmtInsert->close();
    $mysqli->close();
}


