<?php
include('user_control.php');
include('header.php');
include('nav.php');

if(isset($_GET['delete_id'])){
    $tid = getget('delete_id');
    $delete_row = "id=".$tid;
    $del = $db->delete("artist_melody",$delete_row);
}
if(isset($_POST['update'])){
    $tid = getpost('update_id');
    $art_id = getpost('artist_id');
    $id = getget('id');
//    $update_row = "artist_id=".$art_id;
//    $where_row = "id=".$tid." AND melody_id=".$id;
//    $update = $db->update("artist_melody",$update_row,$where_row);
    $update = $db->selectpuresql("UPDATE artist_melody SET artist_id=".$art_id." WHERE id=".$tid." AND melody_id=".$id);
}

if(isset($_POST['save'])){
    $artist_id = getpost('artist_id');
    $song_id = getpost('hidden');
    $insert_array = array("artist_id"=>$artist_id,"melody_id"=>$song_id);
    $in = $db->insert("artist_melody", $insert_array);

}

$id=0;
if(isset($_GET['id'])) $id = getget('id');
if(isset($_POST['id'])) $id = getpost('id');
$song_name = $db->select_one("melody","id='".$id."'");
if ($id){
    $song = $db->selectpuresql("SELECT t.id as tid, t.artist_id, a.name  FROM artist_melody t inner join artist a on a.id = t.artist_id where t.melody_id = '".$id."'order by t.id");
    $cid = $db->selectpuresql("SELECT COUNT(t.artist_id) as cid FROM artist_melody t inner join artist a on a.id = t.artist_id where t.melody_id = '".$id."'");
}
//}
//else $song = $db->selectpuresql("SELECT * FROM melody where song like '' ORDER BY artist");

?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-md-12">
            <h4 class="page-header"><?php if($id){ echo empty($song_name['song'])?"[без названия]":$song_name['song'];}?></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5"><h3>Аткаруучулар</h3></div>
    </div>
    <?php
    $artist = $db->select("artist");
    foreach($song as $row){
        $count++;
    ?>
        <h4 class="col-md-1"><?=$count;?></h4>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?=$id;?>">
        <div class="row">
            <div class="form-group col-md-5">
                <div class="ui-widget">
                    <div class="row">
                        <h4 class="col-md-5"><?=$row['name'];?></h4>
                        <?php foreach($cid as $c_id){if($c_id['cid'] > 1){ ?>
                        <div class="col-md-2">
                            <a onclick="return confirm('e brat ochurup atasyn. Proceed?')" href="change_singer.php?id=<?php echo $id; ?>&delete_id=<?php echo $row['tid']; ?>" class="btn btn-primary">ochur</a>
                        </div>
                        <?php } } ?>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <select id="combobox<?=$row['artist_id'];?>" name="artist_id" class="form-control">
                                <option value="">Select one...</option>
                                <?php
                                foreach($artist as $art){
                                    ?>
                                    <option value="<?php echo $art['id']; ?>" <?php if($art['id']==$row['artist_id']) echo "selected"; ?>><?php echo $art['name']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <script type="text/javascript">
                                $(function() {
                                    $( "#combobox<?=$row['artist_id'];?>" ).combobox();
                                    $( "#toggle" ).click(function() {
                                        $( "#combobox<?=$row['artist_id'];?>" ).toggle();
                                    });
                                });
                            </script>
                        </div>
                        <div class="col-md-2">
                            <input type="hidden" name="update_id" value="<?php echo $row['tid']; ?>">
                            <input type="submit" name="update" class="btn btn-primary" value="алмаштыр">
<!--                            <a onclick="return confirm('e brat almawtyryp atasyn. Proceed?')" href="change_singer.php?id=--><?php //echo $id; ?><!--&update_id=--><?php //echo $row['tid']; ?><!--" class="btn btn-primary">алмаштыр</a>-->
<!--                            <a onclick="return confirm('e brat almawtyryp atasyn. Proceed?')" href="change_singer.php?id=--><?php //echo $id; ?><!--&update_id=--><?php //echo $row['tid']; ?><!--" class="btn btn-primary">алмаштыр</a>-->
                        </div>
                    </div>




                </div>
            </div>

        </div>


    </form>
        <hr>



<?php
    }
?>
    <div class="row">
        <div class="col-md-2">
            <a data-toggle="collapse" href="#collapseExample<?=$song['artist_id'];?>C" aria-expanded="false" aria-controls="collapseExample" class="btn btn-primary">Жаңы аткаруучу кош</a>
        </div>
    </div>

    <div class="collapse" id="collapseExample<?=$song['artist_id'];?>C">
        <form method="post" action="">
            <input type="hidden" name="hidden" value="<?=$id;?>">
            <div class="row">
                <div class="form-group col-md-6">
                    <div class="ui-widget">
                        <label for="singer">Аткаруучу</label><br>

                        <select id="combobox" name="artist_id" class="form-control">
                            <option value="">...</option>
                            <?php
                            $artist = $db->select("artist");
                            foreach($artist as $art){
                                ?>
                                <option value="<?php echo $art['id']; ?>"><?php echo $art['name']; ?></option>
                            <?php
                            }
                            ?>
                        </select>

                    </div>
                </div>
            </div>
            <input class="btn btn-primary" type="submit" name="save" value="кош">
        </form>
    </div>

</div>
<?php
include 'footer.php';
?>