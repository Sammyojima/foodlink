<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = intval($_POST['id']);
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE donations SET status=? WHERE id=?");
    $stmt->bind_param("si", $status, $id);

    if ($stmt->execute()) {
        header("Location: ../admin.php?success=1");
        exit();
    } else {
        echo "❌ Error updating status: " . $stmt->error;
    }
}
?>
