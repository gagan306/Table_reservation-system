<?php
$host = 'localhost';
$dbname = 'cafe_db';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $admin_username = 'admin';
    $admin_password = 'admin123';
    $hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO admin (username, password) VALUES (?, ?)");
    $stmt->execute([$admin_username, $hashed_password]);

    echo "Admin user created successfully!";

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?> 