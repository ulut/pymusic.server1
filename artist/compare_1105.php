<?php
include('main_header.php');
include('header.php');
if (isset($_POST['mysinger'])){
	$singer1 = intval(getpost('mysinger'));
	$singer2 = intval(getpost('vs'));
	if ($singer1*$singer2==0) redirect('compare.php', 'js');
	
	$radio_days = " and pm.date_played >= '".date("Y-m-d",strtotime('-1 day'))."' ";
	
	$period = intval(getpost('period'));
	
	if($period==1) $radio_days = " and pm.date_played >= '".date("Y-m-d",strtotime('-7 days'))."' ";
	else if($period==2) $radio_days = " and pm.date_played >= '".date("Y-m-d",strtotime('-30 days'))."' ";
	else if($period==3) $radio_days = " ";
	
	$query = "select pm.radio_id, count(pm.track_id) as total, a.name as artist, a.id as artist_id
			from played_melody pm, artist a,artist_melody am,melody m
			where a.id = am.artist_id
			and am.melody_id = m.id 
			".$radio_days."  
			and m.track_id=pm.track_id
			AND( a.id = '".$singer1."' OR a.id = '".$singer2."') 
			GROUP BY pm.radio_id, artist_id 
			ORDER BY pm.radio_id";
	$compare_result = $db->selectpuresql($query);
	$first_name_ar= $db->selectpuresql("select name from artist where id=".$singer1);
	$second_name_ar= $db->selectpuresql("select name from artist where id=".$singer2); 
	$first_name = $first_name_ar[0]['name'];
	$second_name = $second_name_ar[0]['name'];

    // Abakan edit for log

    // log compare
    $session_userid = $_SESSION['userid'];
	$session_username = $_SESSION['user_name'];
    $date_view = date('d-m-Y');
    $time_viev = date('H-i-s');
    $REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];// айпи пользователя
    $REQUEST_URI = $_SERVER['REQUEST_URI']; // определяем запрашиваемую страницу
    $message = '';

    $insert = array(
        "date_view" => $date_view,
        "time_view" => $time_viev,
        "userid" => $session_userid,
        "singer1" => $singer1,
        "singer2" => $singer2,
		"username" => $session_username,
        "singername1" => $first_name,
        "singername2" => $second_name
    );
    $result = $db->insert(DB_PREFIX ."logcompare",$insert);
    // log compare end

    // Abakan edit for log end
	
	
}
$period_nm = array("Кечээ күнү","Соңку 7 күндө","Соңку 1 айда","Жалпы");
?>
    <link rel="stylesheet" href="ui/1.11.4/jquery-ui.css"/>
    <link rel="stylesheet" href="jquery-ui.min.css"/>
    <div class="content container">
        <div class="row">

            <div class="col s12 m12 l10 offset-l1">
                <div class="card white z-depth-2 stats">
                    <div class="card-content no-padding">
                        <h4 class="card-title center">
                            Салыштыруу
                        </h4>

                        <div class="row">
                            <form method="post" class="col s12 l10 offset-l1 song-form" id="live-search-example">
                                <div class="row">
                                    <div class="input-field center col s12 m6 l6">
                                        
										<?php if (count($singer_list)>0) {?>
										
										<select name="mysinger" class="form-control">
										<?php if (count($singer_list)>1) {?>
                                            <option value="" disabled selected hidden>Ырчы тандaңыз</option>
                                        <?php } ?>    
											<?php foreach($singer_list as $singer){ ?>
											
                                           <option value="<?php echo $singer['id'];?>" <?php if ($singer1==$singer['id']) echo 'selected'; ?>><?php echo $singer['name'];?></option>
											<?php } ?>
                                        </select>
										<?php } ?>
                                        <label>Ырчы</label>
                                    </div>
                                    <div class="input-field center col s12 m6 l6">
                                        <div class="ui-widget">

                                                <select id="combobox" name="vs" class="form-control">
                                                    <option value="" disabled selected hidden>Ырчы тандaңыз</option>
                                                    <?php
                                                    $artist_list = $db->select("artist", "", "*", "order by name");
                                                    foreach($artist_list as $singer) {
                                                        ?>
                                                        <option value="<?php echo $singer['id'];?>" <?php if ($singer2==$singer['id']) echo 'selected'; ?>><?php echo $singer['name'];?></option>
                                                    <?php } ?>
                                                </select>
                                            <label>Ырчы</label>

                                        </div>


                                    </div>
                                </div>
								<div class="clearfix"></div>
									<div class="row">
										<div id="radio">
									
										<input type="radio" id="radio1" name="period" value="0" <?php if (!$period ) echo "checked";?>><label for="radio1"><?php echo $period_nm[0]; ?></label>&nbsp;&nbsp;
										<input type="radio" id="radio2" name="period" value="1" <?php if ($period ==1 ) echo "checked";?>><label for="radio2"><?php echo $period_nm[1]; ?></label>&nbsp;&nbsp;
										<input type="radio" id="radio3" name="period" value="2" <?php if ($period==2 ) echo "checked";?>><label for="radio3"><?php echo $period_nm[2]; ?></label>&nbsp;&nbsp;
										<input type="radio" id="radio4" name="period" value="3" <?php if ($period==3 ) echo "checked";?>><label for="radio4"><?php echo $period_nm[3]; ?></label>
									
									   
										<script>
										$(function() {
											$( "#radio" ).buttonset();
										});
										</script>
									</div>
								</div>
                                <div class="clearfix"></div>

                                <div class="row">
                                    <div class="input-field center">
                                        <button class="btn waves-effect waves-light" type="submit" name="action">Салыштыр
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
			
			<?php if (isset($singer1)) { ?>
			
            <div class="col s12 m12 l10 offset-l1">
                <div class="card white z-depth-2 compare radios">
                    <div class="card-content no-padding ">
                        <h4 class="card-title center-align">
                            <span class="col l5 m5 s5"><?php echo $first_name;?></span>
                            <span class="col l2 m2 s2 vert-divider center">
                                <i class="mdi-action-star-rate"></i>
                            </span>
                            <span class="col l5 m5 s5"><?php echo $second_name;?></span>

                            <div class="clearfix"></div>
                        </h4>
                        <div class="card-panel col l8 offset-l2 m10 offset-m1 s10 offset-s1 clearfix">

                            <?php
							$total1 = 0;
							$total2 = 0;
							$radios = $db->select("radio");
							foreach($radios as $radio) {
							$singer1_total=0;
							$singer2_total=0;
							foreach($compare_result as $compare){
								if ($compare['radio_id']==$radio['id']){
									if ($compare['artist_id']==$singer1) $singer1_total = $compare['total'];
									if ($compare['artist_id']==$singer2) $singer2_total = $compare['total'];
								}
								if ($singer1_total>0 && $singer2_total>0) break;
							}
							
							$total1 += $singer1_total;
							$total2 += $singer2_total;
							if ($singer1_total+$singer2_total > 0) {
							$singer1_percent = round(100 * $singer1_total / ($singer1_total+$singer2_total));
							$singer2_percent = round(100 * $singer2_total / ($singer1_total+$singer2_total));
							} else $singer1_percent = $singer2_percent = 0;
							?>
							
							<div class="row center">

                                <div class="progress-outer-left">
                                    <div class="progress-wrap progress-wrap1<?php echo $radio['id'];?> progress1 progress-<?php echo $singer2_total>$singer1_total?"lost":"win";?>" data-progress-percent="<?php echo $singer1_percent;?>">
                                        <div class="progress-bar progress-bar1<?php echo $radio['id'];?> progress1"></div>
                                    </div>

                                    <span class="pin pin1<?php echo $radio['id'];?> pin-<?php echo $singer2_total>$singer1_total?"lost":"win";?>">
                                        <?php echo $singer1_percent;?>%
                                    </span>

                                </div>
                                
                                    <?php //if ($radio['logo']) { 
									if (1) { $radid = $radio['id'];
									?>
									<a class="waves-effect waves-light btn btn-large btn-floating">
									<img src="images/radios/<?php echo $radio['logo'];?>" alt="<?php echo $radio_names[$radid];?>"/>
                                	</a>
									<?php } else {
									$rid = $radio['id']; ?>
									<div>
									<?php
									echo $radio_names[$rid];
									?>
									</div>
									<?php }
									?>

                                <div class="progress-outer-right">
                                    <div class="progress-wrap progress-wrap2<?php echo $radio['id'];?> progress1 progress-<?php echo $singer2_total<$singer1_total?"lost":"win";?>" data-progress-percent="<?php echo $singer2_percent;?>">
                                        <div class="progress-bar progress-bar2<?php echo $radio['id'];?> progress1"></div>
                                    </div>
                                    <span class="pin pin2<?php echo $radio['id'];?> pin-<?php echo $singer2_total<$singer1_total?"lost":"win";?>">
                                        <?php echo $singer2_percent;?>%
                                    </span>
                                </div>

                            </div>
							<?php } ?>
                            
                            <div class="row divider-row">
                                <div class="divider"></div>
                            </div>
							<?php
							if ($total1+$total2 > 0) {
								$singer1_percent = round(100 * $total1 / ($total1+$total2));
								$singer2_percent = round(100 * $total2 / ($total1+$total2));
							} else {
								$singer1_percent = $singer2_percent = 0;
							}
							?>

                            <div class="row center total">
                                <h6 class="total-left teal-text"><?php echo $singer1_percent;?>%</h6>
								
								<?php if ($total1>$total2) { ?>
								
                                <a class="waves-effect waves-light btn btn-large btn-floating teal btn-left">
                                    <i class="mdi-action-thumb-up"></i>
                                </a>
								
								<?php } else if ($total1<$total2) { ?>
								
								<a class="waves-effect waves-light btn btn-large btn-floating custom-red btn-right">
                                    <i class="mdi-action-thumb-down"></i>
                                </a>
								
								<?php } else { ?>
								
                                <a class="waves-effect waves-light btn btn-large btn-floating red lighten-2">
                                    <i class="mdi-action-accessibility"></i>
                                </a>
								
								<?php } ?>
								
                                
                                <h6 class="total-right custom-red-text"><?php echo $singer2_percent;?>%</h6>
                            </div>
							
							<div class="row center total"><br />

							Салыштыруу мөөнөтү : <?php echo $period_nm[$period]; ?><br />

							Жыйынтыгы: <?php echo $singer1_percent;?> : <?php echo $singer2_percent;?> эсебинде 
							<?php if ($total1>$total2) { ?>
								
                               уттуңуз.
								
								<?php } else if ($total1<$total2) { ?>
								
								утулдуңуз.
								
								<?php } else { ?>
								
                                тең чыктыңыз.
								
								<?php } ?>
							</div>

                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
			<?php } ?>

        </div>
    </div>

    <script type="text/javascript" src="ui/1.11.4/jquery-ui.js"></script>
    <script type="text/javascript" src="jquery-ui.js"></script>
    <script type="text/javascript" src="jquery-ui-admin-js.js"></script>
    <script type="text/javascript" src="jquery-1.11.2.min.js"></script>
<?php include('footer.php'); ?>