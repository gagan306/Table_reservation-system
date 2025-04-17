<?php
// deletetable.php

$servername = "localhost"; // Change if necessary
$username = "root"; // Change to your database username
$password = ""; // Change to your database password
$dbname = "cafe_db"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the table ID from the request
$data = json_decode(file_get_contents("php://input"), true);
$tableId = $data['id'];

// Delete the table
$sql = "DELETE FROM tables WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $tableId);
$success = $stmt->execute();

header('Content-Type: application/json');
echo json_encode(['success' => $success]);

$stmt->close();
$conn->close();
?>