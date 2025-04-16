<?php
// admin_update_reasons.php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reasons = json_decode($_POST['reasons'], true);

    $conn->query("DELETE FROM reasons"); // Usuwanie istniejących powodów
    $stmt = $conn->prepare("INSERT INTO reasons (name) VALUES (?)");

    foreach ($reasons as $reason) {
        $stmt->bind_param("s", $reason);
        $stmt->execute();
    }
    echo "Powody wizyt zostały zaktualizowane.";
}
?>
