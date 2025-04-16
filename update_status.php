<?php
// update_status.php - Aktualizacja wyświetlanego numeru
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $host = 'localhost';
    $dbname = 'queue_system';
    $user = 'root';
    $password = '';
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($action === 'next') {
        try {
            // Zapytanie SQL
            $stmt = $conn->prepare("DELETE FROM tickets WHERE id = ?");
            $stmt->execute([$_SESSION['current_ticket']]);
            // Zapytanie SQL
            $sql = "SELECT id FROM tickets ORDER BY id ASC LIMIT 1";
            $stmt = $pdo->query($sql);
        
            // Pobranie wyniku
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $_SESSION['current_ticket'] = $result['id'];
            } else {
                $_SESSION['current_ticket'] = null; // Brak rekordów w tabeli
            }
        
            echo "Aktualny bilet: " . ($current_ticket ?? 'Brak biletów');
        } catch (PDOException $e) {
            echo "Błąd połączenia z bazą danych: " . $e->getMessage();
        }
        //$_SESSION['current_ticket']++;
    } elseif ($action === 'stop') {
        try {
            // Zapytanie SQL
            $stmt = $conn->prepare("DELETE FROM tickets WHERE id = ?");
            $stmt->execute([$_SESSION['current_ticket']]);
            // Zapytanie SQL
            $sql = "SELECT id FROM tickets ORDER BY id ASC LIMIT 1";
            $stmt = $pdo->query($sql);
        
            // Pobranie wyniku
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $_SESSION['current_ticket'] = $result['id'];
            } else {
                $_SESSION['current_ticket'] = null; // Brak rekordów w tabeli
            }
        
            echo "Aktualny bilet: " . ($current_ticket ?? 'Brak biletów');
        } catch (PDOException $e) {
            echo "Błąd połączenia z bazą danych: " . $e->getMessage();
        }
        unset($_SESSION['current_ticket']);
    } else {
        // Zapytanie SQL
        $stmt = $conn->prepare("DELETE FROM tickets WHERE id = ?");
        $stmt->execute([$_SESSION['current_ticket']]);
        $_SESSION['current_ticket'] = $action;
    }

    echo json_encode(["current_ticket" => $_SESSION['current_ticket'] ?? null]);
}
?>
