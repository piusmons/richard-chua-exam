<?php


require_once 'database.php';


header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST, OPTIONS');

header('Access-Control-Allow-Headers: Origin, Content-Type, Accept');

$sql_channels = "SELECT * FROM youtube_channels";
$result_channels = $conn->query($sql_channels);

$channels_data = array();
if ($result_channels->num_rows > 0) {
    while ($row = $result_channels->fetch_assoc()) {
        $channels_data[] = $row;
    }
}

$sql_videos = "SELECT * FROM youtube_channel_videos";
$result_videos = $conn->query($sql_videos);

$videos_data = array();
if ($result_videos->num_rows > 0) {
    while ($row = $result_videos->fetch_assoc()) {
        $videos_data[] = $row;
    }
}

$data = array(
    'channels' => $channels_data,
    'videos' => $videos_data
);

$jsonData = json_encode($data);

ob_clean();

header('Content-Type: application/json');
echo $jsonData;


?>
