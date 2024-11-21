<?php
$servername = "localhost";
$username = "adminmysql";
$password = "P@ssw0rd";
$dbname = "analisis_hospitalito_ira";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>