<?php


include '../database/db_connect.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $newRole = ($_POST['newRole'] === 'admin') ? 1 : 0;
    if(trim($_POST['newEmail'])===""){
        if(trim($_POST["newName"])===""){

            $query ="update users set isAdmin = :newRole where u_email = :email";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':newRole', $newRole);
            $stmt->bindParam(':email', $_POST['email']);
            $stmt->execute();
            if($stmt->rowCount() > 0){
                echo 'success';
            }
            else{
                echo 'error';
            }
        }
        else{
            $query = "update users set isAdmin = :newRole, u_name = :newName where u_email = :email";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':newRole', $newRole);
            $stmt->bindParam(':newName', $_POST['newName']);
            $stmt->bindParam(':email', $_POST['email']);
            $stmt->execute();
            
            if($stmt->rowCount() > 0){
                echo 'success';
            }
            else{
                echo 'error';
            }
        }
    }
    else{
        if(trim($_POST["newName"])===""){
            $query = "update users set isAdmin = :newRole, u_email = :newEmail where u_email = :email";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':newRole', $newRole);
            $stmt->bindParam(':newEmail', $_POST['newEmail']);
            $stmt->bindParam(':email', $_POST['email']);
            $stmt->execute();
            if($stmt->rowCount() > 0){
                echo 'success';
            }
            else{
                echo 'error';
            }
            
        }
        else{
            $query = "update users set isAdmin = :newRole, u_email = :newEmail, u_name = :newName where u_email = :email";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':newRole', $newRole);
            $stmt->bindParam(':newEmail', $_POST['newEmail']);
            $stmt->bindParam(':newName', $_POST['newName']);
            $stmt->bindParam(':email', $_POST['email']);
            $stmt->execute();
            if($stmt->rowCount() > 0){
                echo 'success';
            }
            else{
                echo 'error';
            }
        }
    }

}
else{
    echo 'error';
}
    
    