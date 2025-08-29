<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $donation_id = $_POST['donation_id'];

    // Update status to 'requested'
    $stmt = $conn->prepare("UPDATE donations SET status = 'requested' WHERE id = ?");
    $stmt->bind_param("i", $donation_id);

    if ($stmt->execute()) {
        echo "✅ You have successfully requested this food item!";
        echo "<br><a href='../recipient.php'>⬅ Back to available donations</a>";
    } else {
        echo "❌ Error: " . $stmt->error;
    }
}
?>
