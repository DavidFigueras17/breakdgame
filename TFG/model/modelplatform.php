<?php
 $servername = "localhost";
 $username = "root"; // Nombre de usuario de la base de datos
 $password = ""; // Contraseña de la base de datos
 $dbname = "breakdgame";

 $limite = 16;
 $limite = isset($_GET['aumentarLimite']) ? $limite + 8 : $limite;
 $conn = new mysqli($servername, $username, $password, $dbname);

 // Verificar la conexión
 if ($conn->connect_error) {
     die("Conexión fallida: " . $conn->connect_error);
 }

 // Consulta SQL
 if (isset($_GET['platform'])) {
     $platform = $_GET['platform'];
 } else {
     // Maneja el caso en el que no se proporcionó un ID en la URL.
     echo "platform no especificado.";
 }

 $sql = "SELECT * FROM videojuegos where Plataforma='$platform' OR Plataforma='Todas' limit $limite";

 $result = $conn->query($sql);
?>