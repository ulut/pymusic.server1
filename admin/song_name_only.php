<?php
    include('../config.php');

    $song_id = $_GET['song_id'];
    $song_name = $_GET['song_name'];

    $result = $db->update("melody",array("song"=>$song_name),"id='".$song_id."'");

?>