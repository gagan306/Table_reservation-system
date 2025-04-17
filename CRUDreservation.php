<?php
// Enable error reporting
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 1);
header('Content-Type: application/json');

// Database connection
$mysqli = new mysqli('localhost', 'root', '', 'cafe_db');
if ($mysqli->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $mysqli->connect_error]);
    exit;
}




function fetchReservations($mysqli) {
    $today = date('Y-m-d');
    $tomorrow = date('Y-m-d', strtotime('+1 day'));

    try {
        // Fetch reservations for today
        $queryToday = "SELECT r.id, r.name, r.time_from, r.time_to, r.table_number, t.name AS table_name, r.mobile, r.AppRejected_by
                       FROM reservations r 
                       JOIN tables t ON r.table_number = t.id 
                       WHERE DATE(r.time_from) = ? AND r.status = 'approved'";

        $stmtToday = $mysqli->prepare($queryToday);
        $stmtToday->bind_param("s", $today);
        $stmtToday->execute();
        $todayResults = $stmtToday->get_result();
        $todayData = $todayResults->fetch_all(MYSQLI_ASSOC);

        // Debugging: Print the raw results for today
        error_log(print_r($todayData, true));  // Log to PHP error log to see the fetched data

        // Fetch reservations for tomorrow
        $queryTomorrow = "SELECT r.id, r.name, r.time_from, r.time_to, r.table_number, t.name AS table_name, r.mobile, r.AppRejected_by
                          FROM reservations r 
                          JOIN tables t ON r.table_number = t.id 
                          WHERE DATE(r.time_from) = ? AND r.status = 'approved'";

        $stmtTomorrow = $mysqli->prepare($queryTomorrow);
        $stmtTomorrow->bind_param("s", $tomorrow);
        $stmtTomorrow->execute();
        $tomorrowResults = $stmtTomorrow->get_result();
        $tomorrowData = $tomorrowResults->fetch_all(MYSQLI_ASSOC);

        // Debugging: Print the raw results for tomorrow
        error_log(print_r($tomorrowData, true));  // Log to PHP error log to see the fetched data

        // Return the data including 'AppRejected_by'
        echo json_encode(['status' => 'success', 'today' => $todayData, 'tomorrow' => $tomorrowData]);

    } catch (Exception $e) {
        // If there's an error, return an error message
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
}






// Fetch reservation by ID
function fetchReservation($mysqli, $id) {
    $query = "SELECT r.*, t.name AS table_name 
              FROM reservations r 
              JOIN tables t ON r.table_number = t.id 
              WHERE r.id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $data = $stmt->get_result()->fetch_assoc();
    echo json_encode(['status' => 'success', 'reservation' => $data ?: null]);
    $stmt->close();
}

// Search Reservations by Username
function searchReservationsByUsername($mysqli, $username) {
    $username = $mysqli->real_escape_string($username);
    $stmt = $mysqli->prepare("SELECT r.id, r.name, r.time_from, r.time_to, r.table_number, t.name AS table_name, r.mobile 
                              FROM reservations r 
                              JOIN tables t ON r.table_number = t.id 
                              WHERE r.name LIKE ? and r.status ='approved'");
    $likeUsername = "%$username%";
    $stmt->bind_param("s", $likeUsername);
    $stmt->execute();
    $result = $stmt->get_result();
    echo json_encode(['status' => 'success', 'reservations' => $result->fetch_all(MYSQLI_ASSOC)]);
    $stmt->close();
}

// Update Reservation (unchanged)
function updateReservation($mysqli, $data) {
    $id = (int)$data['id'];
    $name = $mysqli->real_escape_string($data['name']);
    $fromTime = $mysqli->real_escape_string($data['from_time']);
    $toTime = $mysqli->real_escape_string($data['to_time']);
    $tableNo = (int)$data['table_no'];
    $mobileNo = $mysqli->real_escape_string($data['mobile_no']);

    $earliestTime = '08:00:00';
    $latestTime = '22:00:00';

    if ($fromTime < $earliestTime || $toTime > $latestTime) {
        echo json_encode(['status' => 'error', 'message' => 'Reservation times must be between 8:00 AM and 10:00 PM.']);
        return;
    }

    $conflictQuery = "SELECT COUNT(*) FROM reservations WHERE table_number = ? 
                  AND status IN ('pending', 'approved') 
                  AND ((time_from < ? AND time_to > ?) OR (time_from < ? AND time_to > ?)) AND id != ?";

    $stmt = $mysqli->prepare($conflictQuery);
    $stmt->bind_param("issssi", $tableNo, $toTime, $toTime, $fromTime, $fromTime, $id);
    $stmt->execute();
    $stmt->bind_result($conflictCount);
    $stmt->fetch();
    $stmt->close();

    if ($conflictCount > 0) {
        echo json_encode(['status' => 'error', 'message' => 'Time slot is already booked.']);
        return;
    }

    $updateQuery = "UPDATE reservations SET name=?, time_from=?, time_to=?, table_number=?, mobile=? WHERE id=?";
    $stmtUpdate = $mysqli->prepare($updateQuery);
    $stmtUpdate->bind_param("sssisi", $name, $fromTime, $toTime, $tableNo, $mobileNo, $id);
    
    if ($stmtUpdate->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update reservation.']);
    }
    
    $stmtUpdate->close();
}

// Check Conflict (unchanged)
if ($_GET['action'] === 'checkConflict') {
    header('Content-Type: application/json');
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($data['table_no']) || !isset($data['from_time']) || !isset($data['to_time']) || !isset($data['id'])) {
        echo json_encode(['status' => 'error', 'message' => 'Missing required parameters']);
        exit;
    }

    $table_no = (int)$data['table_no'];
    $from_time = $data['from_time'];
    $to_time = $data['to_time'];
    $current_id = (int)$data['id'];

    try {
        $sql = "SELECT * FROM reservations 
        WHERE table_number = ? 
        AND id != ? 
        AND status IN ('pending', 'approved') 
        AND (
            (time_from <= ? AND time_to > ?) OR
            (time_from < ? AND time_to >= ?) OR
            (time_from >= ? AND time_to <= ?)
        )";

        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("iissssss", $table_no, $current_id, $to_time, $from_time, $to_time, $from_time, $from_time, $to_time);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $conflict = $result->fetch_assoc();
            echo json_encode([
                'status' => 'conflict',
                'conflictDetails' => [
                    'from_time' => $conflict['time_from'],
                    'to_time' => $conflict['time_to']
                ]
            ]);
        } else {
            echo json_encode(['status' => 'available']);
        }
        $stmt->close();
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
    exit;
}

// Delete Reservation (unchanged)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'deleteReservation') {
    header('Content-Type: application/json');
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (isset($data['id']) && is_numeric($data['id'])) {
        $id = (int)$data['id'];
        $stmt = $mysqli->prepare("DELETE FROM reservations WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'Reservation deleted successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error deleting reservation: ' . $stmt->error]);
            }
            $stmt->close();
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to prepare statement.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid reservation ID.']);
    }
    exit;
}

// Handle requests
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'fetchReservations':
            fetchReservations($mysqli);
            break;
        case 'fetchReservation':
            fetchReservation($mysqli, (int)$_GET['id']);
            break;
        case 'updateReservation':
            $data = json_decode(file_get_contents('php://input'), true);
            updateReservation($mysqli, $data);
            break;
        case 'searchReservationsByUsername':
            searchReservationsByUsername($mysqli, $_GET['username']);
            break;
    }
}

$mysqli->close();
?>