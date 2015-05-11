<?php
    include('main_header.php');
    include('header.php');
	include('today_top_10.php');
?>

<div class="content container">
    <div class="row">
		
		
		<?php if (count($singer_list)) { ?>
        <div class="col s12 m12 l12 hide-on-small-and-down">
            <div class="card custom-red lighten-1 z-depth-2 singers">
                <div class="card-content white-text">
                    <ul class="collection">
					<?php 
						foreach($singer_list as $singer){ ?>
                        <li class="collection-item col s12 m6 l3">
                            <a href="">
                                <span class="artist-img">
                                    <img src="images/singers/empty_star.png" alt=""/>
                                </span>
                                <h4><?php echo $singer['name'];?></h4>
                            </a>
                        </li>
                       <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
		<?php } ?>

        <div class="col s12 m12 l12">
            <div class="card grey-gradient lighten-1 z-depth-1 marquees">
                <div class="card-content">
                    <h4 class="card-title">Радиолордогу акыркы коюлган ырлар</h4>
                    <div class="card-panel">
                        <div class="slide-radios" id="radiolately">
                            
							
							<!---  RADIO LATELY MARQUEE  --->
							<?php
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
							
							
							
							
							
							
                        </div>
                    </div>
                    <h4 class="card-title">Бүгүнкү ырлар ТОП-10</h4>
                    <div class="card-panel">
                        <div class="slide-radios">
                            
							<!---  TOP 10 SONGS MARQUEE  --->
							<?php
							$counter = 0;
							foreach($leader_song[0] as $res) { $counter++;
							
?>						
							<div class="slide-radio">
                                <span class="place"><?php echo $counter;?></span>
                                <strong class="song-name"><?php echo $res['song'];?></strong> - 
								<em class="artist-name"><?php echo $res['artist_name']; ?></em>
                                <span>
								
								<?php if ($res['movement']==0.5) { $arrow="fa-star";?> 
					<?php } else if ($res['movement']>9) { $arrow="fa-rocket";?>+<?php echo $res['movement']; ?>
					<?php } else if ($res['movement']>0) { $arrow="fa-arrow-up";?>+<?php echo $res['movement']; ?>
					<?php } else if ($res['movement']<0) { $arrow="fa-arrow-down";?>-<?php echo $res['movement']; ?>
					<?php } else { $arrow="fa-circle-o";?> <?php } ?>
								
								</span>
                                <i class="fa <?php echo $arrow; ?>"></i>
                            </div>
<?php 
if ($counter ==10) break;
} ?>
							
							
                            
                        </div>
                    </div>
                    <h4 class="card-title">Бүгүнкү аткаруучулар ТОП-10</h4>
                    <div class="card-panel">
                        <div class="slide-radios">
                            
							<?php
							$counter = 0;
							foreach($leader_singer[0] as $res) { $counter++;
							
							
							
							
?>						
							
							<div class="slide-radio">
                                <span class="place place-singer"><?php echo $counter;?></span>
                                <strong class="artist"><?php echo $res['artist']; ?></strong>
                                <span>
								
					<?php if ($res['movement']==0.5) { $arrow="fa-star";?> 
					<?php } else if ($res['movement']>9) { $arrow="fa-rocket";?>+<?php echo $res['movement']; ?>
					<?php } else if ($res['movement']>0) { $arrow="fa-arrow-up";?>+<?php echo $res['movement']; ?>
					<?php } else if ($res['movement']<0) { $arrow="fa-arrow-down";?>-<?php echo $res['movement']; ?>
					<?php } else { $arrow="fa-circle-o";?> <?php } ?>
								
								</span>
                                <i class="fa <?php echo $arrow;?>"></i>
                            </div>
							
<?php 
if ($counter ==10) break;
} ?>
							
							
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
		
		<?php if (count($singer_list)) { ?>
		
		<?php
			$today_radios_sql = "select pm.*, m.song from played_melody pm 
								  inner join melody m on m.track_id=pm.track_id 
								  inner join artist_melody am ON m.id = am.melody_id
								  inner join artist a ON a.id = am.artist_id
								  where pm.date_played >= CURDATE()
								  AND a.id in (".$singer_ids.")
								  ORDER BY pm.radio_id, pm.time_played desc";
			//echo $today_radios_sql;
			$radio_result_raw = $db->selectpuresql($today_radios_sql);
			$radio_result = array();
			foreach($radio_result_raw as $item){
				$radio_id = $item['radio_id'];
				$radio_result[$radio_id][] = $item;
			}
		?>

        <div class="col s12 m12 l6 offset-l3">
            <div class="card white z-depth-2 radios">
                <div class="card-content white-text">
                    <h4 class="card-title center-align">Бүгүн</h4>

                    <div class="card-panel">

                        <ul class="collapsible" data-collapsible="accordion">
							<?php if (count($radio_result_raw)) { 
							foreach($radio_result as $radio) {
							$radio_id = $radio[0]["radio_id"];
							?>
                            <li>
                                <div class="collapsible-header"><?php echo $radio_names[$radio_id];?><span class="badge"><?php echo count($radio); ?></span></div>
                                <div class="collapsible-body">

                                    <ul class="collection">
                                        <?php foreach ($radio as $radio_item) { ?>

                                            <li class="collection-item">
                                                <span><?php echo $radio_item['song']; ?></span>
                                                <h6>
                                                    <i class="mdi-action-today"></i>
                                                    <?php echo $radio_item['date_played']; ?>
                                                    <span>
                                                        <i class="mdi-action-schedule"></i>
                                                        <?php echo $radio_item['time_played']; ?>
                                                    </span>
                                                </h6>
                                            </li>
                                        <?php } ?>
                                    </ul>

                                </div>
                            </li>
                            <?php }} else { ?>
							<li> <div class="collapsible-header">Бүгүн радиолордон ырыңыз кете элек...</div></li>
							<?php } ?>
                        </ul>

                    </div>

                </div>

            </div>


        </div>
		
		

        <div class="col s12 m12 l12">
            <div class="card white z-depth-2 stats">
                <div class="card-content no-padding">
                    <h4 class="card-title center">
                        Статистика
                    </h4>

                    <div class="row">
                        <form action="stat.php" method="post" name="singer_stat" class="col s12 l10 offset-l1 song-form">
                            <div class="input-field center col s12 m6 l6">
                                <select name="singer">
                                    <?php foreach($singer_list as $singer){ ?>
									<option value="<?php echo $singer['id'];?>"><?php echo $singer['name'];?></option>
									<?php } ?>
                                </select>
                            </div>
                            <div class="input-field center col s12 m6 l6">
                                <select name="radio">
                                    <option value="0" selected>Бүт радиолор</option>
									<?php foreach($radio_names as $key=>$value){ ?>
									<option value="<?php echo $key;?>"><?php echo $value;?></option>
									<?php } ?>
                                </select>
                            </div>
                            <div class="input-field col s12 m6 l3 offset-l3 from-date">
                                <input name="from" placeholder="" type="text" class="datepicker prefix-after">
                                <i class="mdi-action-today prefix center"></i>
                            </div>
                            <div class="input-field col s12 m6 l3 to-date">
                                <input name="until" placeholder="" type="text" class="datepicker prefix-after">
                                <i class="mdi-action-today prefix center"></i>
                            </div>

                            <div class="row">
                                <div class="input-field col s12 m12 l12 center">
                                    <button class="btn waves-effect waves-light" type="submit" name="action">Изде
                                    </button>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>

		<?php } ?>


    </div>
</div>


<?php include('footer.php'); ?>