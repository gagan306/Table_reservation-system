<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database configuration
$servername = "localhost"; // Change if necessary
$username = "root"; // Your DB username
$password = ""; // Your DB password
$dbname = "cafe_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["success" => false, "error" => "Database connection failed: " . $conn->connect_error]));
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check for required fields
    if (empty($_POST['name']) || empty($_POST['mobile_no']) || empty($_POST['Post']) || empty($_POST['password']) || empty($_POST['date']) || empty($_POST['login_code'])) {
        echo json_encode(["success" => false, "error" => "All fields are required."]);
        exit;
    }

    $name = $_POST['name'];
    $mobile_no = $_POST['mobile_no'];
    $post = $_POST['Post'];
    $password = $_POST['password'];
    $date = $_POST['date'];
    $login_code = $_POST['login_code'];

    // Prepare SQL statement
    $sql = "INSERT INTO employees (name, mobile_no, post, password, joined_date, login_code) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $name, $mobile_no, $post, $password, $date, $login_code);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => $stmt->error]);
    }

    $stmt->close();
}

$conn->close();
?>
