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

// Get the year and month from the query parameters
$year = $_GET['year'] ?? null;
$month = $_GET['month'] ?? null;

if (!$year || !$month) {
    die(json_encode(['success' => false, 'message' => 'Year and month parameters are required.']));
}

try {
    // Fetch reserved dates for the given month and year
    $stmt = $conn->prepare('SELECT reservation_date FROM reservation_dates WHERE YEAR(reservation_date) = ? AND MONTH(reservation_date) = ?');
    $stmt->bind_param('ii', $year, $month);
    $stmt->execute();
    $result = $stmt->get_result();

    $reservedDates = [];
    while ($row = $result->fetch_assoc()) {
        $reservedDates[] = $row['reservation_date'];
    }

    $response = ['success' => true, 'reservedDates' => $reservedDates];
} catch (Exception $e) {
    $response = ['success' => false, 'message' => $e->getMessage()];
} finally {
    if (isset($stmt)) $stmt->close();
    $conn->close();
}

echo json_encode($response);
?>