<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost"; // Your MySQL server
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "cafe_db"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch tables for a specific date
if (isset($_GET['action']) && $_GET['action'] == 'get_tables') {
    $date = $_GET['date'];
    $tables = [];

    for ($i = 1; $i <= 10; $i++) { // Assuming there are 10 tables
        $tables[$i - 1]['number'] = $i;
        $tables[$i - 1]['is_reserved'] = false;

        // Check if the table is reserved for the selected date
        $sql = "SELECT * FROM reservations WHERE table_number = ? AND DATE(time_from) = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $i, $date);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $tables[$i - 1]['is_reserved'] = true;
        }
    }

    echo json_encode($tables);
    exit();
}

// Fetch reservation details for a specific table
if (isset($_GET['action']) && $_GET['action'] == 'get_reservation') {
    $table_number = $_GET['table_number'];
    $date = $_GET['date'];

    $sql = "SELECT * FROM reservations WHERE table_number = ? AND DATE(time_from) = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $table_number, $date);
    $stmt->execute();
    $result = $stmt->get_result();

    $reservations = [];
    while ($row = $result->fetch_assoc()) {
        $reservations[] = $row;
    }

    echo json_encode($reservations);
    exit();
}

// Make a reservation
if (isset($_GET['action']) && $_GET['action'] == 'make_reservation') {
    $input = json_decode(file_get_contents("php://input"), true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(['success' => false, 'message' => 'Invalid JSON input.']);
        exit();
    }

    $name = $input['name'];
    $mobile = $input['mobile'];
    $table_number = $input['table_number'];
    $time_from = $input['time_from'];
    $time_to = $input['time_to'];

    // Check if the time slot is available
    $sql = "SELECT * FROM reservations WHERE table_number = ? AND ((time_from <= ? AND time_to > ?) OR (time_from < ? AND time_to >= ?))";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Database error (prepare): ' . $conn->error]);
        exit();
    }
    $stmt->bind_param("issss", $table_number, $time_from, $time_from, $time_to, $time_to);
    if (!$stmt->execute()) {
        echo json_encode(['success' => false, 'message' => 'Database error (execute): ' . $stmt->error]);
        exit();
    }
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'The selected time slot is already reserved.']);
        exit();
    }

    // Insert the reservation
    $sql = "INSERT INTO reservations (name, mobile, table_number, time_from, time_to) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Database error (prepare insert): ' . $conn->error]);
        exit();
    }
    $stmt->bind_param("ssiss", $name, $mobile, $table_number, $time_from, $time_to);
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error making reservation (execute insert): ' . $stmt->error]);
    }
    exit();
}

$conn->close();
?>
