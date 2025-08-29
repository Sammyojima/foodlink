<?php
$config = require 'paystack_config.php';
$secretKey = $config['secret_key'];

$email = $_POST['email'];
$amount = $_POST['amount'] * 100; // convert Naira to Kobo

$data = [
    "email" => $email,
    "amount" => $amount,
    "callback_url" => "http://localhost/foodlink_starter/php/callback.php"
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.paystack.co/transaction/initialize");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $secretKey",
    "Cache-Control: no-cache",
]);

$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);

if ($result['status']) {
    $authUrl = $result['data']['authorization_url'];
    header("Location: " . $authUrl); // redirect user to Paystack checkout
    exit;
} else {
    echo "⚠️ Error initializing transaction: " . $result['message'];
}
