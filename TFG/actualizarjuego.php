<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['idadmin']; // Asegúrate de pasar el id del videojuego a actualizar desde JavaScript
    $titulo = $_POST['tituloadmin'];
    $genero = $_POST['generoadmin'];
    $plataforma = $_POST['plataformaadmin'];
    $precio = $_POST['precioadmin'];
    $stock = $_POST['stockadmin'];
    $puntuacion = $_POST['puntuacionadmin'];
    $sinopsis = $_POST['sinopsisadmin'];
    $imagen = $_POST['imagenadmin'];

    $mysqli = new mysqli("localhost", "id21544442_david", "Sicparvismagna-17", "id21544442_breakdgame");
    if ($mysqli->connect_error) {
        die("Error de conexión: " . $mysqli->connect_error);
    }

    // Cambié $sql a $query para que coincida con el nombre de la variable que estás utilizando
    $query = "UPDATE `videojuegos` SET `Titulo`='$titulo', `Genero`='$genero', `Plataforma`='$plataforma', `Precio`='$precio', `Stock`='$stock', `Sinopsis`='$sinopsis', `Imagen`='$imagen', `Puntuacion`='$puntuacion' WHERE `Idvideojuego`='$id'";
    echo $query;
    // Preparar la declaración
    $stmt = $mysqli->prepare($query);

    // Verificar si la preparación fue exitosa
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $mysqli->error);
    }

    // Ejecutar la consulta
    $stmt->execute();

    // Verificar si la ejecución fue exitosa
    if ($stmt->affected_rows > 0) {
        echo "Actualización exitosa";
    } else {
        echo "No se realizó ninguna actualización";
    }

    // Cerrar la conexión y liberar los recursos
    $stmt->close();
    $mysqli->close();
}
