<?php
include 'header.php';
include 'nav.php';
$song_id = $_GET['id'];
$rr=$db->selectpuresql("UPDATE uploaded_song SET approve_flag=1 WHERE id=".$song_id);
$res=$db->selectpuresql('INSERT approved_songs SELECT * FROM uploaded_song WHERE approve_flag = 1');
redirect('unproved_songs.php');
?>