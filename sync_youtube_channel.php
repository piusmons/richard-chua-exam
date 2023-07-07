<?php

$API_key = 'AIzaSyAJmxJeaNXfkU5HCWTbWtZ-fUiCYJD8ihc';
$channelId = 'UCWJ2lWNubArHWmf3FIHbfcQ';
$maxResults = 100;

$apiError = "error!";

function getChannelInfo(){
  global $API_key, $channelId, $apiError;
  try{
    $url = 'https://youtube.googleapis.com/youtube/v3/channels?part=snippet,contentDetails&id='.$channelId.'&key='.$API_key;
    $apiData = @file_get_contents($url);

    if ($apiData === false)
    throw new Exception("invalid call");
  }

  error_log($apiData);

} catch(Exception $e) {
  global $apiError
  $apiError = $e->getMessage();
}

?>

