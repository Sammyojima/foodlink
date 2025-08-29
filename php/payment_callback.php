<?php
// Placeholder for payment callback handling (IntaSend integration should verify payment server-side)
// This file should be called by your payment provider or used as the redirect URL after checkout.
file_put_contents(__DIR__.'/../logs/payment_callback.log', date('c') . " - callback\\n", FILE_APPEND);
echo 'Payment callback received. (Placeholder)';
?>