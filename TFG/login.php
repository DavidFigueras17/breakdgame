<?php



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["correo"];
    $contrasena = $_POST["contrasena"];



    $mysqli = new mysqli("localhost", "id21544442_david", "Sicparvismagna-17", "id21544442_breakdgame");
    if ($mysqli->connect_error) {
        die("Error de conexión: " . $mysqli->connect_error);
    }
    $consulta = "SELECT Idusuario, Nombre, admin, password FROM cliente WHERE Correo = '$correo'";
    $resultado = $mysqli->query($consulta);

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $hashedPasswordFromDatabase = $fila['password'];

        // Verifica la contraseña proporcionada con el hash almacenado en la base de datos
        if (password_verify($contrasena, $hashedPasswordFromDatabase)) {
            // La contraseña es válida
            session_start();
            $idUsuario = $fila['Idusuario'];
            $nombreUsuario = $fila['Nombre'];
            $esAdmin = $fila['admin'];
            $_SESSION['idUsuario'] = $idUsuario;
            $_SESSION['nombreUsuario'] = $nombreUsuario;
            $_SESSION['esAdmin'] = $esAdmin;
            $_SESSION['sesion_iniciada'] = true;

            echo json_encode(['status' => 'success', 'sesion_iniciada' => true, 'usuario' =>  $_SESSION['nombreUsuario'], 'usuario_id' => $_SESSION['idUsuario'], 'administrador' => $_SESSION['esAdmin']]);
           
        } else {
            echo json_encode(['status' => 'error']);
        }
    } else {
        echo json_encode(['status' => 'error']);
    }
}
