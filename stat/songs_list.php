<?php
include('../config.php');
include('header.php');
include('nav.php');
include('getcontrol.php');

$artist_id = $_GET['art_id'];

$artist_name = $db->select_one('artist','id = '.$artist_id.'','name');
$all_songs_of_artist = $db -> selectpuresql('SELECT m.song, m.artist FROM artist_melody AS a INNER JOIN melody AS m ON a.melody_id = m.id AND a.artist_id = '.$artist_id.'');



?>



<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h4 class="page-header"><?=$artist_name['name'];?></h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-offset-2 col-md-10">
            <?php
            foreach($all_songs_of_artist as $every_song){
                $count++;
                ?>
                <a class="col-md-1" href="#"><?=$count;?></a>
                <a class="col-md-offset-1 col-md-10" href="#"><?=empty($every_song['song'])?"[без названия][без названия][без названия][без названия]":$every_song['song'];?></a>

            <?php
            }
            ?>

        </div>
    </div>

</div>