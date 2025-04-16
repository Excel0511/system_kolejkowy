<?php
// display_current_ticket.php
session_start();
header("Content-Type: application/json");

echo json_encode(["current_ticket" => $_SESSION['current_ticket'] ?? null]);
?>
