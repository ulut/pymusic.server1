<?php
include('main_header.php');
include('header.php');
?>

    <div class="content container">
        <div class="row">

            <div class="col s12 m12 l10 offset-l1">
                <div class="card white z-depth-2 radios">
                    <div class="card-content no-padding">
                        <h4 class="card-title center">
                            Ырларым
                        </h4>

                        <ul class="collapsible songs-collapsible" data-collapsible="accordion">
                            <?php

                            $table_artist = $db->selectpuresql("select * from artist where id in (".$singer_ids.")");

                            foreach($table_artist as $key=>$row){
                                $key = $key+1;

                                ?>
                                <li <?php if($key == 1) echo "active";?>>
                                    <div class="collapsible-header artist-header <?php if($key == 1) echo "active";?>"><?php echo $row['name'];?></div>
                                    <div class="collapsible-body">
                                        <ul class="collection artist-songs">
                                            <?php
                                            $song_query = "select m.* from melody m
                                                              inner join artist_melody am ON m.id = am.melody_id
                                                              inner join artist a ON a.id = am.artist_id
                                                              where a.id = ".$row['id']."
                                                              ORDER BY a.id";
                                            $song_result = $db->selectpuresql($song_query);
                                            foreach($song_result as $count=> $result){
                                                $count = $count +1;
                                                ?>

                                                <li class="collection-item col l4 m6 s12 border-right">
                                                    <span class="count"><i class="fa fa-music"></i></span>
                                                    <span class="song-name"><?php echo $result['song']; ?></span>
                                                </li>

                                            <?php } ?>
                                        </ul>
                                    </div>
                                </li>

                            <?php
                            }?>

                        </ul>

                    </div>
                </div>
            </div>

        </div>
    </div>


<?php include('footer.php'); ?>