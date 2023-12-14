<?php
// Conexión a la base de datos
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
if (isset($_GET['id'])) {
    $juegoID = $_GET['id'];
    // Ahora, $juegoID contiene el valor del ID del juego que se pasó en la URL.
    // Puedes usar $juegoID en tu página 'gamepage.php' como desees.
} else {
    // Maneja el caso en el que no se proporcionó un ID en la URL.
    echo "ID de juego no especificado.";
}

$sql = "SELECT * FROM videojuegos where Idvideojuego=$juegoID";

$result = $conn->query($sql);
$game = $result->fetch_assoc();



$sqlopinion = "SELECT * FROM opinion where Idvideojuego=$juegoID";

$resultopinion = $conn->query($sqlopinion);



?>