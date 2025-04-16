<?php
// get_reasons.php - Pobieranie listy powodów wizyty
include 'connect.php';

$result = $conn->query("SELECT id, name FROM reasons");
$reasons = [];
while ($row = $result->fetch_assoc()) {
    $reasons[] = $row;
}
echo json_encode($reasons);
?>
