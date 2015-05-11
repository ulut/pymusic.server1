<?php
include 'user_control.php';
include 'header.php';
include 'nav.php';
if(isset($_GET['delete_id'])){
    $uploaded_song_id = getget('delete_id');
    $delete_song = $db->select_one("uploaded_song", "id=".$uploaded_song_id);
	@unlink($delete_song['filename']);
	$db->delete('uploaded_song',"id='".$uploaded_song_id."'");
	
}
if(isset($_GET['approve_id'])){
$song_id = getget('approve_id');
    if($song_id > 0){
        $db->update("uploaded_song",array("approved_flag"=>1),"id='".$song_id."'");
    }
}
$res=$db->selectpuresql("select us.*, a.name as real_name from uploaded_song us left join uploaded_artist_melody ua on us.id = ua.melody_id left join artist a on ua.artist_id = a.id where us.approved_flag = '0';");
?>
<div id="page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Жаңы ырлардын тизмеси</h2>
            </div>
        </div>

    <div class="row">
        <div class="col-md-3">
            <h5><i><b>Плеер</b></i></h5>
        </div>
        <div class="col-md-2">
            <h5><b><i>Ырчынын аты</i></b></h5>
        </div>
        <div class="col-md-1">
            <h5><i><b>Ырдын аты</b></i></h5>
        </div>
        <div class="col-md-1">
            <h5><i><b>Скачать</b></i></h5>
        </div>
        <div class="col-md-1">
            <h5><i><b>Ким жүктѳдү (username)</b></i></h5>
        </div>
        <div class="col-md-3">
            <h5><i><b>Action</b></i></h5>
        </div>
    </div>
<?php
foreach($res as $key=>$r){

    if($key > 0 && $r['id'] == $res[$key-1]['id']) continue;
    $temp = $key;
    $artist_all = $r['real_name'];
    $counter = 0;
    while(isset($res[$temp+1]) && $res[$temp]['id'] == $res[$temp+1]['id']){
        $counter++;
        $temp++;
    }

    $mp3 = explode("/", $r['filename']);

    ?>
    <div class="row">
        <div class="col-md-3">
            <object type="application/x-shockwave-flash" data="../admin/dewplayer.swf" width="200" height="20" id="dewplayer" name="dewplayer">
                <param name="wmode" value="transparent" />
                <param name="movie" value="dewplayer.swf" />
                <param name="flashvars" value="mp3=../admin/upload_song/<?php echo $mp3[5];?>&amp;showtime=1" />
            </object>        </div>
        <div class="col-md-2">
            <?php if($r['real_name']) { echo $artist_all;
            if($counter > 0){
                echo " (+".$counter.")";
            }
            }
            else {?>
            <h5 style="color: #cccccc">
                <?php
                echo $r['singer_name'];}
            ?></h5>
        </div>
        <div class="col-md-1">
            <?php echo $r['song_name'];?>
        </div>
        <div class="col-md-1">
            <a href="../admin/upload_song/<?php echo $mp3[5];?>" download><img style="width: 3em;" src="../download.png"></a>
        </div>
        <div class="col-md-1">
            <?php echo $r['username'];?>
        </div>
        <div class="col-md-3">
            <a href="song_edit.php?id=<?=$r['id'];?>" class="btn btn-info col-md-4">Изменить</a>
            <a onclick="return confirm('Вы уверены?')" href="unproved_songs.php?delete_id=<?=$r['id'];?>" class="btn btn-info col-md-4" >Удалить</a>
            <?php
            if($r['real_name']){

            ?>
            <a onclick="return confirm('Вы уверены?')" href="unproved_songs.php?approve_id=<?=$r['id'];?>" class="btn btn-info col-md-4">Подтвердить</a>
            <?php
            }
            ?>
        </div>

    </div>
<?php } ?>
    </div>
</div>
