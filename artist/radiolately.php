<?php
include '../config.php';
$result = apc_fetch('artist_radio_lately');
if (!$result) {
	$query = "select a.name as artist_name, m.song as song_name, m.id as melody_id, pm.* from played_melody pm 
			  inner join melody m on m.track_id=pm.track_id 
			  inner join artist_melody am ON m.id = am.melody_id
			  inner join artist a ON a.id = am.artist_id
			  inner join radio r ON r.id = pm.radio_id
			  ORDER BY pm.id desc
			  LIMIT 20
			  ";
	$result1 = $db->selectpuresql($query);
	$result = array();
	$temp_max = count($result1)-1;
			foreach($result1 as $key=>&$singer){
				if ($key>0 && $singer['melody_id'] == $result1[$key-1]['melody_id']) continue;
				$temp_id = $key;
				while ($key!=$temp_max && $result1[$temp_id]['melody_id'] == $result1[$temp_id+1]['melody_id']){
					$singer['artist_name'] .= ", ".$result1[$temp_id+1]['artist_name'];
					$temp_id++;
				}
				$result[] = $singer;
				
			}
	
	apc_store('artist_radio_lately',new ArrayObject($result),30);
}
foreach($result as $res) {
$rad_id = $res['radio_id'];
?>
							<div class="slide-radio">
                                <strong class="red-text"><?php echo $radio_names[$rad_id];?></strong>
                                <i class="fa fa-volume-up"></i>
                                <strong><?php echo $res['artist_name']; ?></strong> - <em><?php echo $res['song_name']; ?></em>
                                <i class="fa fa-clock-o"></i>
                                <span><?php echo date('h:i',strtotime($res['time_played'])); ?></span>
                            </div>
<?php } ?>