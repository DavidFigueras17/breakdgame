<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $idjuego = $_POST['idjuego'];


    $idusuario = $_POST['idusuario'];
    $cantidad = $_POST['cantidad'];
    $fechaFormateada = $_POST['fechaFormateada'];

    $mysqli = new mysqli("localhost", "id21544442_david", "Sicparvismagna-17", "id21544442_breakdgame");
    if ($mysqli->connect_error) {
        die("Error de conexión: " . $mysqli->connect_error);
    }

    // Cambié $sql a $query para que coincida con el nombre de la variable que estás utilizando
    for ($i = 0; $i < count($idjuego); $i++) {


        $insertQuery = "INSERT INTO `compra` (`Fecha`, `Idcliente`, `Idvideojuego`, `cantidad`) VALUES (?, ?, ?, ?)";
        $stmtInsert = $mysqli->prepare($insertQuery);
        $stmtInsert->bind_param("siii", $fechaFormateada, $idusuario, $idjuego[$i], $cantidad);

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
    }
    // Cerrar la conexión y liberar los recursos
    $stmtInsert->close();
    $mysqli->close();
}
