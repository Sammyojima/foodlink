<?php
require __DIR__ . '/db.php';

$reference = $_GET['reference'] ?? null;
$email     = $_GET['email']     ?? null;
$amount    = isset($_GET['amount']) ? (float)$_GET['amount'] : null;
$status    = $_GET['status']    ?? 'failed';

if (!$reference || !$email || !$amount) {
    die('Missing required fields.');
}

$stmt = $conn->prepare("INSERT INTO payments (reference, email, amount, status) VALUES (?, ?, ?, ?)");
$stmt->execute([$reference, $email, $amount, $status]);

?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Payment Result</title></head>
<body>
  <h1>Payment <?= htmlspecialchars($status) ?></h1>
  <p>Reference: <strong><?= htmlspecialchars($reference) ?></strong></p>
  <p>Amount: NGN <?= number_format($amount, 2) ?></p>
  <p>Email: <?= htmlspecialchars($email) ?></p>
  <p><a href="payments.php">View all payments</a> • <a href="index.php">Back home</a></p>
</body>
</html>
