<?php
include '../database/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $newName = $_POST['newName'];
    $price = $_POST['newPrice'];
    $type = $_POST['newType'];

    // Prepare the SQL statement with placeholders
    $query = "UPDATE product
    SET p_name = COALESCE(NULLIF(:newName, ''), p_name),
        p_price = COALESCE(NULLIF(:price, ''), p_price),
        p_type = COALESCE(NULLIF(:type, ''), p_type)
    WHERE p_name = :name";

    // Prepare and execute the statement
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':newName', $newName);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':name', $name);

    $result = $stmt->execute();

    // Check if the update was successful
    if ($result) {
        echo 'success';
    } else {
        echo 'error';
    }
}
?>
