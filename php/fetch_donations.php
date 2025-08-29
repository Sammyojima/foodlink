<?php
include 'db.php';
header('Content-Type: application/json');

$sql = "SELECT d.id,d.food_item,d.quantity,d.expiry_date,d.location,u.name as donor_name FROM donations d JOIN users u ON u.id=d.donor_id WHERE d.status='available' ORDER BY d.created_at DESC";
$res = $conn->query($sql);
$out = [];
while($row = $res->fetch_assoc()){
    $out[] = $row;
}
echo json_encode($out);
?>