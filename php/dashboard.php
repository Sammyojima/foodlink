<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.html"); // redirect if not logged in
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - FoodLink</title>
</head>
<body>
  <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?> 🎉</h2>
  <p>You are logged in successfully!</p>

  <a href="logout.php">Logout</a>
</body>
</html>
