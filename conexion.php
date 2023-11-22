<?php
$servername = "localhost";
$username = "Admin";
$password = "Admin";
$database = "projecte";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>