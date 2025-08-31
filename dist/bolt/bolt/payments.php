<?php
require __DIR__ . '/db.php';
$rows = $conn->query("SELECT id, reference, email, amount, status, created_at FROM payments ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Payments — FoodLink Demo</title>
  <style>
    body { font-family: system-ui, Arial, sans-serif; margin: 24px; max-width: 920px; }
    table { width: 100%; border-collapse: collapse; }
    th, td { border: 1px solid #eee; padding: 8px; text-align: left; }
  </style>
</head>
<body>
  <h1>Payments (Demo)</h1>
  <p><a href="index.php">← Back</a></p>
  <table>
    <thead>
      <tr><th>ID</th><th>Reference</th><th>Email</th><th>Amount</th><th>Status</th><th>Created</th></tr>
    </thead>
    <tbody>
      <?php foreach ($rows as $r): ?>
        <tr>
          <td><?= (int)$r['id'] ?></td>
          <td><?= htmlspecialchars($r['reference']) ?></td>
          <td><?= htmlspecialchars($r['email']) ?></td>
          <td><?= number_format((float)$r['amount'], 2) ?></td>
          <td><?= htmlspecialchars($r['status']) ?></td>
          <td><?= htmlspecialchars($r['created_at']) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>
