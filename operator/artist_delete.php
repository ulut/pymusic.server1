<?php
include('user_control.php');
include('header.php');
include('nav.php');

$art_id = getget('delete_id');
$db->delete("artist","id='".$art_id."'");
redirect("artist_list.php","js");
?>