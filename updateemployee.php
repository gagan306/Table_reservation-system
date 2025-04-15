<?php
// Database connection
$host = 'localhost';
$dbname = 'cafe_db'; // Your database name
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($_POST['action'] === 'update') {
            // Update employee
            $stmt = $pdo->prepare("UPDATE employees SET name = ?, mobile_no = ?, post = ?, password = ?, joined_date = ?, login_code = ? WHERE id = ?");
            $stmt->execute([
                $_POST['name'],
                $_POST['mobile_no'],
                $_POST['post'],
                $_POST['password'],
                $_POST['joined_date'],
                $_POST['login_code'],
                $_POST['id']
            ]);
            echo json_encode(['success' => true]);
        } elseif ($_POST['action'] === 'delete') {
            // Delete employee
            $stmt = $pdo->prepare("DELETE FROM employees WHERE id = ?");
            $stmt->execute([$_POST['id']]);
            echo json_encode(['success' => true]);
        }
    }

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
