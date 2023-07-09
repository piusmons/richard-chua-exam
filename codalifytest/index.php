<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'database.php';
require_once 'sync_youtube_channel.php';
$conn = $GLOBALS['conn'];

fetchChannel($conn);
require_once 'youtube_channel_json.php';
?>


