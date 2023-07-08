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



<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>



<div class="container my-5">

  <h2>PHP To Do List</h2>
  
</div>

</body>
</html>