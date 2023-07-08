<?php


require_once 'database.php';

$sql = "SELECT * FROM youtube_channels";
$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$jsonData = json_encode($data);

header('Content-Type: application/json');


?>
