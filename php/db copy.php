<?php
$host = "sql7.freesqldatabase.com";
$user = "sql7796747";
$pass = "PncYmVFsnI";
$dbname = "sql7796747";
$port = 3306;

$conn = new mysqli($host, $user, $pass, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("❌ DB connection failed: " . $conn->connect_error);
} else {
    // echo "✅ Database connected successfully!";
}
?>
