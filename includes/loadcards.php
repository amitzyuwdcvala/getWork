<?php

require_once dirname(__FILE__) . "/../database/db.php";
$db = new Database();
$conn = $db->getConnection();

try {
    $query = "
        SELECT w.*, u.email, u.profile_picture, u.username
        FROM work w
        JOIN users u ON w.user_id = u.id
        ORDER BY w.created_at DESC
    ";

    $stmt = $conn->prepare($query);

    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }

    if (!$stmt->execute()) {
        throw new Exception("Execute failed: " . $stmt->error);
    }

    $result = $stmt->get_result();

    $results = [];
    while ($row = $result->fetch_assoc()) {
        $results[] = $row;
    }

    return $results;


} catch(Exception $e) {
    echo "Error: " . $e->getMessage();
}

// Close the connection
$conn->close();
?>


