<?php
// Prevent any unwanted output before JSON
ob_start();
header('Content-Type: application/json');

try {
    $db = new PDO('mysql:host=localhost;dbname=cafe_db', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $db->query('SELECT name, capacity, x, y FROM tables');
    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Clear buffer and output JSON
    ob_end_clean();
    echo json_encode([
        'success' => true,
        'tables' => $tables
    ]);

} catch (Exception $e) {
    ob_end_clean();
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
exit; // Ensure no trailing output