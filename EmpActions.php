<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "actions_db"; // Database for actions

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => "Connection failed: " . $conn->connect_error]));
}

// Fetch actions
$sql = "SELECT action_time, name, post, action FROM employee_actions";
$result = $conn->query($sql);

$actions = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $actions[] = $row;
    }
}

// Return JSON response
echo json_encode(['success' => true, 'actions' => $actions]);

$conn->close();
?>
