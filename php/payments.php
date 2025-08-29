<?php
include 'db.php';

// Handle filters
$where = [];
$params = [];

// Filter by email
if (!empty($_GET['email'])) {
    $where[] = "email LIKE ?";
    $params[] = "%" . $_GET['email'] . "%";
}

// Filter by status
if (!empty($_GET['status'])) {
    $where[] = "status = ?";
    $params[] = $_GET['status'];
}

// Filter by date range
if (!empty($_GET['from_date']) && !empty($_GET['to_date'])) {
    $where[] = "DATE(created_at) BETWEEN ? AND ?";
    $params[] = $_GET['from_date'];
    $params[] = $_GET['to_date'];
}

// Build SQL
$sql = "SELECT * FROM payments";
if ($where) {
    $sql .= " WHERE " . implode(" AND ", $where);
}
$sql .= " ORDER BY created_at DESC";

// Prepare statement
$stmt = $conn->prepare($sql);

// Bind params dynamically
if ($params) {
    $types = str_repeat("s", count($params));
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>FoodLink - Payments Dashboard</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 20px; }
    h2 { color: green; }
    form { margin-bottom: 20px; }
    label { margin-right: 10px; }
    input, select { margin-right: 15px; padding: 5px; }
    table { border-collapse: collapse; width: 100%; margin-top: 20px; }
    th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    th { background-color: #f2f2f2; }
    tr:nth-child(even) { background-color: #f9f9f9; }
  </style>
</head>
<body>
  <h2>FoodLink Payments Dashboard</h2>

  <!-- Filter Form -->
  <form method="get">
    <label>Email: <input type="text" name="email" value="<?php echo htmlspecialchars($_GET['email'] ?? ''); ?>"></label>
    <label>Status:
      <select name="status">
        <option value="">-- All --</option>
        <option value="success" <?php if(($_GET['status'] ?? '') == 'success') echo 'selected'; ?>>Success</option>
        <option value="failed" <?php if(($_GET['status'] ?? '') == 'failed') echo 'selected'; ?>>Failed</option>
      </select>
    </label>
    <label>From: <input type="date" name="from_date" value="<?php echo htmlspecialchars($_GET['from_date'] ?? ''); ?>"></label>
    <label>To: <input type="date" name="to_date" value="<?php echo htmlspecialchars($_GET['to_date'] ?? ''); ?>"></label>
    <button type="submit">Filter</button>
    <a href="payments.php"><button type="button">Reset</button></a>
  </form>

  <!-- Results Table -->
  <table>
    <tr>
      <th>ID</th>
      <th>Email</th>
      <th>Amount (₦)</th>
      <th>Reference</th>
      <th>Status</th>
      <th>Date</th>
    </tr>
    <?php if ($result->num_rows > 0): ?>
      <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
          <td><?php echo $row['id']; ?></td>
          <td><?php echo htmlspecialchars($row['email']); ?></td>
          <td><?php echo number_format($row['amount'] / 100, 2); ?></td>
          <td><?php echo $row['reference']; ?></td>
          <td><?php echo $row['status']; ?></td>
          <td><?php echo $row['created_at']; ?></td>
        </tr>
      <?php } ?>
    <?php else: ?>
      <tr><td colspan="6">No records found</td></tr>
    <?php endif; ?>
  </table>
</body>
</html>
