<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tituloa = $_POST['tituloa'];

    // Consultar si ya existe un juego con el mismo título
    $mysqli = new mysqli("localhost", "id21544442_david", "Sicparvismagna-17", "id21544442_breakdgame");
    if ($mysqli->connect_error) {
        die("Error de conexión: " . $mysqli->connect_error);
    }
    $query = "SELECT Idvideojuego FROM videojuegos WHERE Titulo = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $tituloa);
    $stmt->execute();
    $stmt->store_result();
    $num_rows = $stmt->num_rows;


    
    if ($num_rows > 0) {
        echo 'false';
    } else {
        echo 'true';
    }

    
    $stmt->close();
    exit();
}


?>
