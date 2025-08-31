<?php
// Demo "initialize" — no external API call, just simulate a redirect to callback
$email  = $_POST['email']  ?? '';
$amount = (float)($_POST['amount'] ?? 0);

if (!$email || $amount <= 0) {
    die('Invalid payment data.');
}

$ref = 'ref_' . bin2hex(random_bytes(5));

// Simulate gateway redirect back as success
$query = http_build_query([
    'reference' => $ref,
    'email'     => $email,
    'amount'    => $amount,
    'status'    => 'success'
]);
header('Location: bolt/callback.php?' . $query);
exit;