<?php
include '../database/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Prepare the SQL statement with a placeholder for the product name
    $query = "DELETE FROM product WHERE p_name = :id";
    $stmt = $conn->prepare($query);

    // Bind the product name parameter
    $stmt->bindParam(':id', $id);

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
