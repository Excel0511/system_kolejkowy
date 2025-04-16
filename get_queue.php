<?php
// get_queue.php - Pobieranie kolejki
include 'connect.php';

$result = $conn->query("SELECT t.id, r.name FROM tickets t JOIN reasons r ON t.reason_id = r.id ORDER BY t.id ASC");
$queue = [];
while ($row = $result->fetch_assoc()) {
    $queue[] = $row;
}
echo json_encode($queue);
?>
