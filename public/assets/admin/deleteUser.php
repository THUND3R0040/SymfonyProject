<?php
include '../database/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['userEmail'];

    // Prepare the SQL statement with a placeholder for the email
    $query = "DELETE FROM users WHERE u_email = :email";
    $stmt = $conn->prepare($query);

    // Bind the email parameter
    $stmt->bindParam(':email', $email);

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
