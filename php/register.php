<?php
include 'db.php'; // DB connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // For hackathon demo we’ll keep password in plain text (later, use password_hash)
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        echo "✅ Registration successful. You can now login.";
        // Optionally redirect to login
        // header("Location: login.html");
    } else {
        echo "❌ Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
