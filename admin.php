<!-- Donations Table -->
<h2>Donations</h2>
<?php if ($donations->num_rows > 0) { ?>
  <table>
    <tr>
      <th>ID</th>
      <th>Donor</th>
      <th>Food Item</th>
      <th>Quantity</th>
      <th>Location</th>
      <th>Contact</th>
      <th>Status</th>
      <th>Action</th>
      <th>Created</th>
    </tr>
    <?php while($row = $donations->fetch_assoc()) { ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo htmlspecialchars($row['donor_name']); ?></td>
        <td><?php echo htmlspecialchars($row['food_item']); ?></td>
        <td><?php echo htmlspecialchars($row['quantity']); ?></td>
        <td><?php echo htmlspecialchars($row['location']); ?></td>
        <td><?php echo htmlspecialchars($row['contact']); ?></td>
        <td class="status-<?php echo strtolower($row['status']); ?>">
          <?php echo ucfirst($row['status']); ?>
        </td>
        <td>
          <?php if ($row['status'] !== 'completed') { ?>
            <form method="POST" action="php/update_status.php" style="display:inline;">
              <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
              <select name="status">
                <option value="available" <?php if($row['status']=="available") echo "selected"; ?>>Available</option>
                <option value="requested" <?php if($row['status']=="requested") echo "selected"; ?>>Requested</option>
                <option value="completed" <?php if($row['status']=="completed") echo "selected"; ?>>Completed</option>
              </select>
              <button type="submit">Update</button>
            </form>
          <?php } else { ?>
            ✅ Completed
          <?php } ?>
        </td>
        <td><?php echo $row['created_at']; ?></td>
      </tr>
    <?php } ?>
  </table>
<?php } else { ?>
  <p>No donations yet.</p>
<?php } ?>
