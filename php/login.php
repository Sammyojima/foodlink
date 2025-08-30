<?php
session_start();
include 'db.php'; // this connects to freesqldatabase

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $username, $hashed_password);
        $stmt->fetch();

        // For demo we are using plain text password (not hashed)
        if ($password === $hashed_password) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;

            echo "✅ Login successful. Welcome " . htmlspecialchars($username);
            // Redirect to dashboard (create dashboard.php later)
            // header("Location: dashboard.php");
            exit;
        } else {
            echo "❌ Invalid password";
        }
    } else {
        echo "❌ No account found with that email.";
    }

    $stmt->close();
}
$conn->close();
?>
