<?php
// admin_change_password.php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_password = $_POST['password'];
    $stmt = $conn->prepare("UPDATE settings SET value = ? WHERE name = 'admin_password'");
    $stmt->bind_param("s", $new_password);
    $stmt->execute();
    echo "Hasło zostało zmienione.";
}
?>
