<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $donor_name = $_POST['donor_name'];
    $food_item  = $_POST['food_item'];
    $quantity   = $_POST['quantity'];
    $location   = $_POST['location'];
    $contact    = $_POST['contact'];

    // Always insert with status = available
    $stmt = $conn->prepare("INSERT INTO donations (donor_name, food_item, quantity, location, contact, status) VALUES (?, ?, ?, ?, ?, 'available')");
    $stmt->bind_param("sssss", $donor_name, $food_item, $quantity, $location, $contact);

    if ($stmt->execute()) {
        echo "✅ Thank you, your donation has been submitted and is now available.";
        echo "<br><a href='../donor.html'>Go Back</a>";
    } else {
        echo "❌ Error: " . $stmt->error;
    }
}
?>
