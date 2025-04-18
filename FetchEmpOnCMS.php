<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cafe_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $action = $_POST['action'];

    if ($action === 'login') {
        $login_code = $_POST['login_code'];

        $stmt = $conn->prepare("SELECT * FROM employees WHERE id = ? AND login_code = ?");
        $stmt->bind_param("is", $id, $login_code);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
        $stmt->close();
    } elseif ($action === 'logout') {
        echo json_encode(['success' => true]);
    }
} else {
    $sql = "SELECT id, name, post FROM employees";
    $result = $conn->query($sql);

    $employees = [];
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
    echo json_encode($employees);
}

$conn->close();
?>
