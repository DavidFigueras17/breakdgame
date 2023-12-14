<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $contrasena = $_POST["contrasena"];
    $email = $_POST["email"];
    $direccion = $_POST["direccion"];
    $fecha = $_POST["fecha"];

    $mysqli = new mysqli("localhost", "id21544442_david", "Sicparvismagna-17", "id21544442_breakdgame");
    if ($mysqli->connect_error) {
        die("Error de conexión: " . $mysqli->connect_error);
    }

    $consulta = "SELECT Correo FROM cliente WHERE Correo = '$email'";
    $resultado = $mysqli->query($consulta);

    // Preparar el array para la respuesta JSON
    $response = array();

    if ($resultado->num_rows == 0) {
        $hashedPassword = password_hash($contrasena, PASSWORD_DEFAULT);
        $valueAdmin = 0;
        $insert = "INSERT INTO cliente (Nombre, Apellido, Correo, Direccion, Fechanacimiento, admin, password) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $mysqli->prepare($insert);
        $stmt->bind_param("sssssis", $nombre, $apellido, $email, $direccion, 
        $fecha, 
        $valueAdmin, 
        $hashedPassword);
        $stmt->execute();
        $response['status'] = 'success';
    } else {
        $response['status'] = 'error';
    }

    // Enviar la respuesta JSON solo
    header('Content-Type: application/json');
    echo json_encode($response);

    // Cerrar la conexión a la base de datos
    $mysqli->close();
}
?>
