<?php
// callback.php

// 1. Check if reference exists
if (!isset($_GET['reference'])) {
    die("❌ No reference supplied.");
}

$reference = $_GET['reference'];

// 2. Verify transaction with Paystack
$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        "Authorization: Bearer sk_test_844b902b26662f7a510ff639db56dcdc1136bfed",
        "Cache-Control: no-cache",
    ],
]);

$response = curl_exec($ch);
if (curl_errno($ch)) {
    die("❌ cURL Error: " . curl_error($ch));
}
curl_close($ch);

// 3. Decode response
$result = json_decode($response, true);

if (!$result || !isset($result['data'])) {
    die("❌ Invalid response from Paystack.");
}

// 4. Check transaction status
$data = $result['data'];
if ($data['status'] === 'success') {
    // Extract details safely
    $email = isset($data['customer']['email']) ? $data['customer']['email'] : 'unknown';
    $amount = isset($data['amount']) ? $data['amount'] : 0;
    $status = $data['status'];

    // 5. Save to DB
    include 'db.php';
    $stmt = $conn->prepare("INSERT INTO payments (email, amount, reference, status) VALUES (?, ?, ?, ?)");
    if ($stmt === false) {
        die("❌ DB Prepare Error: " . $conn->error);
    }
    $stmt->bind_param("siss", $email, $amount, $reference, $status);
    $stmt->execute();

    echo "✅ Payment successful! <br> Reference: " . htmlspecialchars($reference);
    echo "<br> Email: " . htmlspecialchars($email);
    echo "<br> Amount: " . ($amount / 100) . " NGN"; // Paystack amount is in kobo
} else {
    echo "❌ Payment failed or not verified. Reference: " . htmlspecialchars($reference);
}
?>