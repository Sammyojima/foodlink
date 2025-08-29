<?php
include 'php/db.php';

// fetch available donations
$sql = "SELECT * FROM donations WHERE status = 'available' ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>FoodLink - Available Donations</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 20px; }
    h2 { color: green; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
    th { background: green; color: white; }
    tr:nth-child(even) { background: #f9f9f9; }
    button { background: darkorange; color: white; padding: 5px 10px; border: none; cursor: pointer; }
    button:hover { background: orangered; }
  </style>
</head>
<body>
  <h2>Available Food Donations 🍲</h2>

  <?php if ($result->num_rows > 0) { ?>
    <table>
      <tr>
        <th>Donor</th>
        <th>Food Item</th>
        <th>Quantity</th>
        <th>Location</th>
        <th>Contact</th>
        <th>Action</th>
      </tr>
      <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
          <td><?php echo htmlspecialchars($row['donor_name']); ?></td>
          <td><?php echo htmlspecialchars($row['food_item']); ?></td>
          <td><?php echo htmlspecialchars($row['quantity']); ?></td>
          <td><?php echo htmlspecialchars($row['location']); ?></td>
          <td><?php echo htmlspecialchars($row['contact']); ?></td>
          <td>
            <form action="php/request.php" method="POST">
              <input type="hidden" name="donation_id" value="<?php echo $row['id']; ?>">
              <button type="submit">Request</button>
            </form>
          </td>
        </tr>
      <?php } ?>
    </table>
  <?php } else { ?>
    <p>❌ No donations available at the moment. Please check back later.</p>
  <?php } ?>
</body>
</html>
