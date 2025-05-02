<?php
header('Content-Type: application/json');

try {
    $db = new PDO('mysql:host=localhost;dbname=cafe_db', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!is_array($input) || empty($input)) {
        throw new Exception('Invalid or empty input data');
    }

   
    $db->beginTransaction();

    // Prepare the UPSERT statement (assumes 'name' is UNIQUE)
    $stmt = $db->prepare('
        INSERT INTO tables (name, capacity, x, y) 
        VALUES (:name, :capacity, :x, :y) 
        ON DUPLICATE KEY UPDATE 
            x = VALUES(x), 
            y = VALUES(y)
    ');

    // Insert or update each table
    foreach ($input as $table) {
        // Validate required fields
        if (!isset($table['name']) || !isset($table['capacity']) || !isset($table['x']) || !isset($table['y'])) {
            throw new Exception('Missing required fields in table data');
        }
        if (!is_string($table['name']) || !is_numeric($table['capacity']) || !is_numeric($table['x']) || !is_numeric($table['y'])) {
            throw new Exception('Invalid data types in table data');
        }

        $stmt->execute([
            ':name' => $table['name'],
            ':capacity' => (int)$table['capacity'], // Ensure integer
            ':x' => (float)$table['x'], // Allow decimals for precision
            ':y' => (float)$table['y']
        ]);
    }

    // Commit the transaction
    $db->commit();

    echo json_encode([
        'success' => true,
        'message' => 'Tables saved successfully'
    ]);

} catch (Exception $e) {
    // Rollback the transaction on error
    if (isset($db)) {
        $db->rollBack();
    }
    
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}