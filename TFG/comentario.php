<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $comentario = $_POST["comentario"];
    $puntuacion = $_POST["puntuacion"];
    $usuario = $_POST["usuario"];
    $idjuego = $_POST["idjuego"];


    $mysqli = new mysqli("localhost", "id21544442_david", "Sicparvismagna-17", "id21544442_breakdgame");
    if ($mysqli->connect_error) {
        die("Error de conexión: " . $mysqli->connect_error);
    }
    $sql = "INSERT INTO opinion (Idusuario, Idvideojuego, Comentario, Puntuacion)  VALUES (?, ?, ?, ?)";
  
   

    // Preparar la declaración
    $stmt = $mysqli->prepare($sql);
    
    // Vincular los parámetros
    $stmt->bind_param("iiss", $usuario, $idjuego, $comentario, $puntuacion );
    
    // Ejecutar la declaración
    if ($stmt->execute()) {
        echo "Comentario añadido exitosamente";
    } else {
        echo "Error al añadir el comentario: " . $stmt->error;
    }
    
    // Cerrar la conexión y liberar los recursos
    $stmt->close();
    $mysqli->close();
}
