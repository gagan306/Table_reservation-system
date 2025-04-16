<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "actions_db";  // Database for actions

// Connection to the employees database (for login code validation)
$emp_dbname = "employee_db"; // Employee database
$emp_conn = new mysqli($servername, $username, $password, $emp_dbname);

// Check connection
if ($emp_conn->connect_error) {
    die(json_encode(['success' => false, 'message' => "Connection failed: " . $emp_conn->connect_error]));
}

// Connection to the actions database (for login/logout tracking)
$actions_conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($actions_conn->connect_error) {
    die(json_encode(['success' => false, 'message' => "Connection failed: " . $actions_conn->connect_error]));
}

// Check the action (login or logout)
$action = $_POST['action'] ?? '';

if ($action == 'login') {
    $name = $_POST['name'] ?? '';
    $post = $_POST['post'] ?? '';
    $login_at = $_POST['login_at'] ?? '';
    $login_code = $_POST['login_code'] ?? '';

    // Validate login code from employee database
    $login_check_sql = "SELECT name FROM employees WHERE name = ? AND login_code = ?";
    $login_stmt = $emp_conn->prepare($login_check_sql);
    
    if ($login_stmt) {
        $login_stmt->bind_param("ss", $name, $login_code);
        $login_stmt->execute();
        $login_result = $login_stmt->get_result();
        
        if ($login_result->num_rows > 0) {
            // Insert login information into employee_actions table
            $sql = "INSERT INTO employee_actions (name, post, action_time, action) VALUES (?, ?, ?, 'login')";
            $stmt = $actions_conn->prepare($sql);
    
            if ($stmt) {
                $stmt->bind_param("sss", $name, $post, $login_at);
                if ($stmt->execute()) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Login failed']);
                }
                $stmt->close();
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to prepare login statement']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid login code']);
        }
        
        $login_stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to validate login code']);
    }
} elseif ($action == 'logout') {
    // Safely retrieve POST data
    $name = $_POST['name'] ?? null;
    $post = $_POST['post'] ?? null;
    $login_at = $_POST['login_at'] ?? null;
    $logout_at = $_POST['logout_at'] ?? null;

    if ($name && $post && $login_at && $logout_at) {
        // Insert logout action into employee_actions table
        $sql = "INSERT INTO employee_actions (name, post, action_time, action) VALUES (?, ?, ?, 'logout')";
        $stmt = $actions_conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sss", $name, $post, $logout_at);
            if ($stmt->execute()) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to execute query.']);
            }
            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to prepare statement.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid data provided.']);
    }
}
$actions_conn->close();
$emp_conn->close();
?>
