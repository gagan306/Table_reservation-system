<?php
// fetchtables.php

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

// Fetch table data
$sql = "SELECT id, name, capacity FROM tables";
$result = $conn->query($sql);

$tables = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tables[] = $row;
    }
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode(['success' => true, 'tables' => $tables]);

$conn->close();
?>