<?php
include('user_control.php');
include('header.php');
include('nav.php');

$res=$db->selectpuresql("select us.*, a.name as real_name, m.song as exist_song, m.filename as exist_filename, exa.name as exist_artist  from uploaded_song us 
													left join uploaded_artist_melody ua on us.id = ua.melody_id 
													left join artist a on ua.artist_id = a.id
													left join melody m ON m.track_id = us.track_id
													left join artist_melody am ON m.id = am.melody_id
													left join artist exa ON exa.id = am.artist_id
													where us.melody_declined_flag = '1'
						");
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Отказ болгон ырлар ))</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3"><b>Ук</b></div>
        <h5 class="col-md-2"><b>Ырчы</b></h5>
        <h5 class="col-md-2"><b>Ыр</b></h5>
		<h5 class="col-md-2"><b>Базада?</b></h5>
        <h5 class="col-md-2"><b>Качан?</b></h5>
        <h5 class="col-md-3"><b>Эмнеге?</b></h5>
    </div>
<?php
foreach ($res as $r){
    $mp3 = explode("/", $r['filename']);
	$exist_mp3_ar = explode("/", $r['exist_filename']);
	$exist_mp3 = $exist_mp3_ar[4];
	for($i=5; $i<count($exist_mp3_ar); $i++){
			$exist_mp3 .= "/".$exist_mp3_ar[$i];
	}
	
    ?>

    <div class="row">
        <div class="col-md-3">
            <object type="application/x-shockwave-flash" data="../admin/dewplayer.swf" width="200" height="20" id="dewplayer" name="dewplayer">
                <param name="wmode" value="transparent" />
                <param name="movie" value="dewplayer.swf" />
                <param name="flashvars" value="mp3=../admin/upload_song/<?php echo $mp3[5];?>&amp;showtime=1" />
            </object>
			
        </div>
        <h5 class="col-md-2"><?=$r['singer_name'];?></h5>
        <h5 class="col-md-2"><?=$r['song_name'];?></h5>
		<h5 class="col-md-2"><object type="application/x-shockwave-flash" data="../admin/dewplayer.swf" width="200" height="20" id="dewplayer" name="dewplayer">
                <param name="wmode" value="transparent" />
                <param name="movie" value="dewplayer.swf" />
                <param name="flashvars" value="mp3=../admin/Music/<?php echo $exist_mp3;?>&amp;showtime=1" />
            </object>
			<?=$r['exist_artist'];?> <?=$r['exist_song'];?>
			</h5>
        <h5 class="col-md-2"><?=$r['uploaded_date'];?></h5>
        <h6 class="col-md-3"><?=$r['melody_declined_error'];?></h6>
    </div>
<?php } ?>
    </div>