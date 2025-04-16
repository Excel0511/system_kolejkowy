<?php
// process.php - Obsługa wyboru powodu wizyty

require_once 'connect.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $reason_id = $input['reason_id'] ?? null;
    if (!$reason_id) {
        http_response_code(400); // Zwrot błędu 400 (Bad Request) jeśli reason_id jest pusty
        echo json_encode(['error' => 'reason_id is required']);
        exit;
    }
    $stmt = $conn->prepare("INSERT INTO tickets (reason_id, created_at) VALUES (?, NOW())");
    $stmt->bind_param("i", $reason_id);
    $stmt->execute();
    $ticket_id = $conn->insert_id;
    $stmt->close();

    // Zwracamy numer biletu
    echo json_encode(["ticket_id" => $ticket_id]);
}
?>