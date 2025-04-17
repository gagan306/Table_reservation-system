<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

// Database connection
$host = 'localhost';
$db = 'cafe_db';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(['success' => false, 'message' => 'No valid JSON data received.']);
    exit;
}

$ids = $data['ids'];  // Array of reservation IDs
$action = $data['action'];  // 'approve' or 'reject'
$employeeName = $data['employee_name'];  // Employee who approved/rejected

// Validate input
if (empty($ids) || !is_array($ids) || !in_array($action, ['approve', 'reject'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid input data.']);
    exit;
}

$status = ($action === 'approve') ? 'approved' : 'rejected';
$placeholders = implode(',', array_fill(0, count($ids), '?'));
$sql = "UPDATE reservations SET status = ?, AppRejected_By = ? WHERE id IN ($placeholders)";

$stmt = $conn->prepare($sql);
if ($stmt === false) {
    echo json_encode(['success' => false, 'message' => 'SQL query preparation failed: ' . $conn->error]);
    exit;
}

$types = 'ss' . str_repeat('i', count($ids)); // 'ss' for status and employee_name, followed by integers for reservation IDs
$params = array_merge([$types, $status, $employeeName], $ids);
call_user_func_array([$stmt, 'bind_param'], refValues($params));

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Reservation status updated successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error updating reservation status: ' . $stmt->error]);
}

$stmt->close();
$conn->close();

function refValues($arr) {
    $refs = [];
    foreach ($arr as $key => $value) {
        $refs[$key] = &$arr[$key];
    }
    return $refs;
}
?>
