<?php
include '../database/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Prepare the SQL statement with a placeholder for the comment ID
    $query = "UPDATE comments SET isAnswered = 1 WHERE c_id = :id";
    $stmt = $conn->prepare($query);

    // Bind the comment ID parameter
    $stmt->bindParam(':id', $id);

    // Execute the statement
    $result = $stmt->execute();

    // Check if the update was successful
    if ($result) {
        echo 'success';
    } else {
        echo 'error';
    }
} else {
    echo 'error';
}
?>
