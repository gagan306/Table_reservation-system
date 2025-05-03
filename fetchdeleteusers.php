<?php
// Database connection
$servername = "localhost"; // Your database server
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "cafe_db"; // Your database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the action is 'delete'
if (isset($_POST['action']) && $_POST['action'] == 'delete' && isset($_POST['user_id'])) {
    // Delete user
    $user_id = $_POST['user_id'];
    $query = "DELETE FROM users WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $user_id);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "User deleted successfully.";
    } else {
        echo "Error deleting user.";
    }

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    exit; // Exit after delete to avoid fetching at the same time
}

// Fetch user data if no delete action
$query = "SELECT id, username, email, created_at FROM users";
$result = mysqli_query($conn, $query);

$users = [];
while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}

// Return the data as JSON
echo json_encode($users);

// Close the database connection
mysqli_close($conn);
?>
