<?php
include '../database/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Prepare the SQL statement with a placeholder for the ID
    $query = "DELETE FROM orders WHERE id = :id";
    $stmt = $conn->prepare($query);

    // Bind the ID parameter
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Execute the statement
    $result = $stmt->execute();

    // Check if the deletion was successful
    if ($result) {
        echo 'success';
    } else {
        echo 'error';
    }
} else {
    echo 'error';
}
?>
