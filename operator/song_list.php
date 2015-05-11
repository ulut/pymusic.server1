<?php
include('../config.php');
include('header.php');
include('nav.php');


if(isset($_POST['save'])){
    $song_name = getpost('song_name');
    $song_id = getpost('hidden');

    $update_array = array("song"=>$song_name);

    $db->update("melody", $update_array, "id='".$song_id."'");

}


$artist_id=0;
if(isset($_GET['artist_id'])) $artist_id = getget('artist_id');
if(isset($_POST['artist_id'])) $artist_id = getpost('artist_id');

if ($artist_id){
    $song = $db->selectpuresql("SELECT m.filename, m.id, m.song, a.name, a.id aid  FROM melody m inner join artist_melody tie on m.id = tie.melody_id inner join artist a on a.id = tie.artist_id where a.id='".$artist_id."' order by m.song");
}else {
    $song = $db->selectpuresql("SELECT * FROM melody where song like '' ORDER BY artist");
}


?>



    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-12">
                <h4 class="page-header"><?php if ($artist_id){ echo $song[0]['name'];}else{ echo "Ырлар";}?></h4>
            </div>
        </div>

        <form action="" method="post">
            <div class="row">
                <div class="form-group col-md-5">
                    <div class="ui-widget">
                        <label for="singer">Исполнитель <?php if(isset($_GET['artist_id'])){ echo $song['name'];} else{ echo " ";} ?></label><br>

                        <select id="combobox" name="artist_id" onchange='this.form.submit()' class="form-control">
                            <option value="">Select one...</option>
                            <?php
                            $artist = $db->select("artist");
                            foreach($artist as $art){
                                ?>
                                <option value="<?php echo $art['id']; ?>" <?php if($art['id']==$artist_id) echo "selected"; ?>><?php echo $art['name']; ?></option>
                            <?php
                            }
                            ?>
                        </select>

                    </div>
                </div>
            </div>
        </form>

        <br>

        <div class="row">
            <div class="col-md-11">
                <?php
                foreach($song as $every_song){

                    $mp3 = explode("/radio/", $every_song['filename']);
                    ?>

                    <a data-toggle="collapse" href="#collapseExample<?=$every_song['id'];?>" aria-expanded="false" aria-controls="collapseExample">
                        <div class="col-md-2">
                            <object type="application/x-shockwave-flash" data="../admin/dewplayer.swf" width="200" height="20" id="dewplayer" name="dewplayer">
                                <param name="wmode" value="transparent" />
                                <param name="movie" value="dewplayer.swf" />
                                <param name="flashvars" value="mp3=../admin/radio/<?php echo $mp3[1];?>&amp;showtime=1" />
                            </object>
                        </div>
                        <h4 class="col-md-offset-1 col-md-4" style="text-align: center;"><?=empty($every_song['song'])?"[без названия]":$every_song['song'];?></h4>
                        <h4 class="col-md-4"><?php if ($artist_id){echo $every_song['name']; }else{echo $every_song['artist'];}?></h4>
                        <a class="col-md-1 btn-primary" href="change_singer.php?id=<?=$every_song['id'];?>">алмаш</a>

                    </a>
                    <div class="collapse" id="collapseExample<?=$every_song['id'];?>">
                        <form method="post" action="">
                            <input type="hidden" name="hidden" value="<?=$every_song['id'];?>">
                            <input type="hidden" name="artist_id" value="<?=$every_song['aid'];?>">
                            <input type="text" name="song_name" value="<?=empty($every_song['song'])?"[без названия]":$every_song['song'];?>">
                            <input class="btn btn-primary" type="submit" name="save" value="Ырдын атын оңдо">
                        </form>
                    </div>
                <?php
                }
                ?>

            </div>
        </div>

    </div>

<?php
include 'footer.php';
?>