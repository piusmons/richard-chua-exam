<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$API_key = 'AIzaSyAJmxJeaNXfkU5HCWTbWtZ-fUiCYJD8ihc';
$channelId = 'UCWJ2lWNubArHWmf3FIHbfcQ';
$maxResults = 50;
$url = 'https://youtube.googleapis.com/youtube/v3/channels?part=snippet,contentDetails&id='.$channelId.'&key='.$API_key;
$apiError = "error!";
$channel_Data = '';
$globalPlaylistId = '';


function fetchChannel(){
  global $channel_Data;
  global $url;
  global $globalPlaylistId;
  global $playlist_url;
  $channel_Data = json_decode(file_get_contents($url));

  require_once 'database.php';
  
  foreach($channel_Data->items as $data){
    $name = $conn->real_escape_string($data->snippet->title);
    $profile_Picture = $conn->real_escape_string($data->snippet->thumbnails->default->url);
    $description = $conn->real_escape_string($data->snippet->description);
    $playlist_id = $conn->real_escape_string($data->contentDetails->relatedPlaylists->uploads);
    
    $sql = "INSERT INTO youtube_channels (name, profile_Picture, description) 
            VALUES ('$name', '$profile_Picture', '$description')";
    if ($conn->query($sql) === TRUE) {
      echo $playlist_id ;
    } else {
      echo "Error inserting channel data: " . $conn->error . "<br>";
    }

   

    $playlistData = fetchPlaylistItems($playlist_id, $conn);

    
  }
  
  
}

function fetchPlaylistItems($playlist_id, $conn,$count = 0)
{
    global $API_key;

    $playlist_url = 'https://youtube.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=50&playlistId='.$playlist_id.'&key='.$API_key;
    $playlistData = json_decode(file_get_contents($playlist_url), true);
    

    require_once 'database.php';

    foreach($playlistData['items'] as $item){
      $name = $conn->real_escape_string($item["snippet"]["title"]);
      $videoLink = $conn->real_escape_string($item["snippet"]['resourceId']['videoId']);
      $thumbnail = $conn->real_escape_string($item["snippet"]['thumbnails']['default']["url"]);
      $description = $conn->real_escape_string($item["snippet"]["description"]);
      
      $sql = "INSERT INTO youtube_channel_videos (title, videoLink, thumbnail, description) 
      VALUES ('$name', '$videoLink', '$thumbnail', '$description' )";
      

      if ($conn->query($sql) === TRUE) {
        echo "Video data inserted successfully.<br>";
        $count++;
        } else {
        echo "Error inserting channel data: " . $conn->error . "<br>";
        }
  }

  $sql = "SELECT COUNT(*) AS count FROM youtube_channel_videos";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $totalCount = $row['count'];

    if ($totalCount < 100 && isset($playlistData['nextPageToken'])) {
        $nextPageToken = $playlistData['nextPageToken'];
        fetchPlaylistItems($playlist_id, $conn, $count);
    } else {
      if ($count >= 100) {
        echo "total count reached 100. stopping. <br>";
      }
      $conn->close();
    }

    
    
}



fetchChannel()


?>