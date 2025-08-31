<?php
// Simple registration handler
include 'db.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $conn->real_escape_string($_POST['role']);
    $location = $conn->real_escape_string($_POST['location']);

    $stmt = $conn->prepare("INSERT INTO users (name,email,password,role,location) VALUES (?,?,?,?,?)");
    $stmt->bind_param('sssss',$name,$email,$password,$role,$location);
    if($stmt->execute()){
        header('Location: ../login.html');
        exit;
    } else {
        echo 'Error: ' . $conn->error;
    }
} else {
    echo 'Invalid request method.';
}
?>