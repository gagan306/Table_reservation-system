<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle POST request: Check table availability and add reservation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $table = $_POST['table'];
    $mobile_no = $_POST['mobile_no'];

    // Convert the time into a datetime object for easier manipulation
    $reservationTime = new DateTime($date . ' ' . $time);
    $startTime = $reservationTime->format('Y-m-d H:i:s');
    $endTime = $reservationTime->modify('+2 hours')->format('Y-m-d H:i:s');

    // Check availability within the 2-hour window
    $stmt = $conn->prepare("SELECT COUNT(*) FROM reservations WHERE table_number = ? AND date = ? AND time BETWEEN ? AND ?");
    $stmt->bind_param("ssss", $table, $date, $startTime, $endTime);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        echo json_encode(["available" => false]);
    } else {
        // Add reservation
        $stmt = $conn->prepare("INSERT INTO reservations (name, date, time, table_number, mobile_no) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $date, $time, $table, $mobile_no);
        $stmt->execute();
        $stmt->close();

        echo json_encode(["available" => true]);
    }
    exit();  // Ensure no additional output is sent
}

$conn->close();
?>
