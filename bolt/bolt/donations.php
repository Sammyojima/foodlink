<?php
require __DIR__ . '/db.php';
$rows = $conn->query("SELECT id, donor_name, food_item, quantity, location, contact, status, created_at FROM donations ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Donations — FoodLink Demo</title>
  <style>
    body { font-family: system-ui, Arial, sans-serif; margin: 24px; max-width: 1100px; }
    table { width: 100%; border-collapse: collapse; }
    th, td { border: 1px solid #eee; padding: 8px; text-align: left; }
    form { display: inline; }
    select, button { padding: 6px 8px; }
  </style>
</head>
<body>
  <h1>Donations</h1>
  <p><a href="index.php">← Back</a></p>
  <table>
    <thead>
      <tr>
        <th>ID</th><th>Donor</th><th>Food</th><th>Qty</th><th>Location</th><th>Contact</th><th>Status</th><th>Created</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($rows as $r): ?>
        <tr>
          <td><?= (int)$r['id'] ?></td>
          <td><?= htmlspecialchars($r['donor_name']) ?></td>
          <td><?= htmlspecialchars($r['food_item']) ?></td>
          <td><?= htmlspecialchars($r['quantity']) ?></td>
          <td><?= htmlspecialchars($r['location']) ?></td>
          <td><?= htmlspecialchars($r['contact']) ?></td>
          <td><?= htmlspecialchars($r['status']) ?></td>
          <td><?= htmlspecialchars($r['created_at']) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>
