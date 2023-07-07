<?php 


$API_key = 'AIzaSyAJmxJeaNXfkU5HCWTbWtZ-fUiCYJD8ihc';
$channelId = 'UCWJ2lWNubArHWmf3FIHbfcQ';
$maxResults = 100;
$url = 'https://youtube.googleapis.com/youtube/v3/channels?part=snippet,contentDetails&id='.$channelId.'&key='.$API_key;
$apiError = "error!";
$channel_Data = '';

function wew(){
  global $channel_Data;
  global $url;
  $channel_Data = json_decode(file_get_contents($url));

  print_r($channel_Data);
}

wew()
?>