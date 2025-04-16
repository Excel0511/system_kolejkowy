<?php
// connect.php - Wspólne połączenie z bazą danych
$host = "localhost";
$username = "root";
$password = "";
$database = "queue_system";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>