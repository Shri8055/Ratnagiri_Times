<?php
$conn = mysqli_connect('localhost', 'root', '', 'pmedia', 4306);
if (!$conn) {
    die(json_encode([]));
}

$term = $_GET['query'] ?? '';
$term = mysqli_real_escape_string($conn, $term);

$sql = "SELECT ac_no, ac_name, cur_bal, city, commission FROM ad_mast WHERE ac_name LIKE '%$term%' LIMIT 10";

$result = mysqli_query($conn, $sql);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data);
?>