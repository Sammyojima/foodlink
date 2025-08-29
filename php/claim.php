<?php
session_start();
include 'db.php';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(!isset($_SESSION['user_id'])){
        die('You must be logged in to claim a donation. <a href="../login.html">Login</a>');
    }
    $donation_id = intval($_POST['donation_id']);
    $ngo_id = intval($_SESSION['user_id']);

    // insert claim
    $stmt = $conn->prepare("INSERT INTO claims (donation_id, ngo_id) VALUES (?,?)");
    $stmt->bind_param('ii',$donation_id,$ngo_id);
    $ok = $stmt->execute();

    // update donation status
    $upd = $conn->prepare("UPDATE donations SET status='claimed' WHERE id=?");
    $upd->bind_param('i',$donation_id);
    $upd->execute();

    if($ok){
        header('Location: ../view_donations.html');
        exit;
    } else {
        echo 'Error claiming donation.';
    }
} else {
    echo 'Invalid request method.';
}
?>