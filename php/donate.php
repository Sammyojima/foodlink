<?php
session_start();
include 'db.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // ensure user is logged in and is donor
    $donor_id = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : null;
    if(!$donor_id){
        die('You must be logged in to post a donation. <a href="../login.html">Login</a>');
    }
    $food_item = $conn->real_escape_string($_POST['food_item']);
    $quantity = $conn->real_escape_string($_POST['quantity']);
    $expiry_date = $conn->real_escape_string($_POST['expiry_date']);
    $location = $conn->real_escape_string($_POST['location']);

    $stmt = $conn->prepare("INSERT INTO donations (donor_id,food_item,quantity,expiry_date,location) VALUES (?,?,?,?,?)");
    $stmt->bind_param('issss',$donor_id,$food_item,$quantity,$expiry_date,$location);
    if($stmt->execute()){
        header('Location: ../dashboard.html');
        exit;
    } else {
        echo 'Error: ' . $conn->error;
    }
} else {
    echo 'Invalid request method.';
}
?>