<?php
require __DIR__ . '/db.php';

// Handle donation submit (SQLite)
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'donate') {
    $donor_name = trim($_POST['donor_name'] ?? '');
    $food_item  = trim($_POST['food_item'] ?? '');
    $quantity   = trim($_POST['quantity'] ?? '');
    $location   = trim($_POST['location'] ?? '');
    $contact    = trim($_POST['contact'] ?? '');

    if ($donor_name && $food_item && $quantity && $location && $contact) {
        $stmt = $conn->prepare("INSERT INTO donations (donor_name, food_item, quantity, location, contact) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$donor_name, $food_item, $quantity, $location, $contact]);
        $msg = '✅ Donation saved (demo).';
    } else {
        $msg = '❌ Please fill all fields.';
    }
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8" />
  <title>FoodLink – Bolt Demo</title>
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <style>
    body { font-family: system-ui, Arial, sans-serif; margin: 24px; max-width: 920px; }
    .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 16px; }
    .card { border: 1px solid #eee; border-radius: 12px; padding: 16px; box-shadow: 0 2px 12px rgba(0,0,0,.04); }
    input, button { padding: 10px; width: 100%; margin: 6px 0; }
    a.button { display: inline-block; padding: 10px 14px; border: 1px solid #ddd; border-radius: 8px; text-decoration: none; }
    table { width: 100%; border-collapse: collapse; margin-top: 12px; }
    th, td { border: 1px solid #eee; padding: 8px; text-align: left; }
    .msg { margin: 12px 0; }
  </style>
</head>
<body>
  <h1>🍲 FoodLink — Bolt Demo</h1>
  <p>This is a lightweight demo running on Bolt with SQLite. Your full PHP+MySQL app remains for local use.</p>
  <?php if ($msg): ?><div class="msg"><?= htmlspecialchars($msg) ?></div><?php endif; ?>

  <div class="grid">
    <div class="card">
      <h2>Donate Surplus Food</h2>
      <form method="post">
        <input type="hidden" name="action" value="donate" />
        <input name="donor_name" placeholder="Donor name" required />
        <input name="food_item"  placeholder="Food item" required />
        <input name="quantity"   placeholder="Quantity" required />
        <input name="location"   placeholder="Location" required />
        <input name="contact"    placeholder="Contact (phone/email)" required />
        <button type="submit">Submit Donation</button>
      </form>
      <p><a class="button" href="donations.php">View Donations</a></p>
    </div>

    <div class="card">
      <h2>Test Payment (Demo)</h2>
      <form method="post" action="pay.php">
        <input name="email"  placeholder="Email" type="email" required />
        <input name="amount" placeholder="Amount (NGN)" type="number" min="100" step="100" required />
        <button type="submit">Initialize Demo Payment</button>
      </form>
      <p><a class="button" href="payments.php">View Payments</a></p>
    </div>
  </div>
</body>
</html>
