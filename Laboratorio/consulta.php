<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registro";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>" . $row["nombre"] . " " . $row["apellido1"] . " " . $row["apellido2"] . "</li>";
    }
    echo "</ul>";
} else {
    echo "No hay usuarios registrados.";
}

$conn->close();
?>