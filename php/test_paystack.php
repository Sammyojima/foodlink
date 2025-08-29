<?php
$config = require 'paystack_config.php';

$secretKey = $config['secret_key'];

// Payment data
$data = [
    "email" => "customer@email.com",
    "amount" => 5000, // in kobo (₦50)
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

if (curl_errno($ch)) {
    echo 'cURL error: ' . curl_error($ch);
} else {
    echo $response; // should return JSON with authorization_url
}

curl_close($ch);
