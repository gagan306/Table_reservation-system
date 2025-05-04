<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'cafe_db';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]));
}

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die(json_encode(['success' => false, 'message' => 'Invalid JSON input.']));
}

$action = $data['action'] ?? null;
$dates = $data['dates'] ?? null;

if (!$action) {
    die(json_encode(['success' => false, 'message' => 'Action parameter is missing.']));
}

$response = ['success' => false];

try {
    if ($action === 'store') {
        if (!$dates || !is_array($dates)) {
            throw new Exception('Dates parameter is missing or invalid.');
        }

        $stmt = $conn->prepare('INSERT INTO reservation_dates (reservation_date) VALUES (?)');
        foreach ($dates as $date) {
            $stmt->bind_param('s', $date);
            if (!$stmt->execute()) {
                throw new Exception('Error executing query: ' . $stmt->error);
            }
        }

        $response = ['success' => true];
    } elseif ($action === 'delete') {
        if (!$dates || !is_array($dates)) {
            throw new Exception('Dates parameter is missing or invalid.');
        }

        $stmt = $conn->prepare('DELETE FROM reservation_dates WHERE reservation_date = ?');
        foreach ($dates as $date) {
            $stmt->bind_param('s', $date);
            if (!$stmt->execute()) {
                throw new Exception('Error executing query: ' . $stmt->error);
            }
        }

        $response = ['success' => true];
    } else {
        throw new Exception('Invalid action.');
    }
} catch (Exception $e) {
    $response = ['success' => false, 'message' => $e->getMessage()];
} finally {
    if (isset($stmt)) $stmt->close();
    $conn->close();
}

echo json_encode($response);
?>
