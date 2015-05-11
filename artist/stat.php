<?php
include('main_header.php');
include('header.php');

$singer = $radio_id = $from = $until = NULL;

if (isset($_POST['singer'])) $singer_id = intval(getpost('singer'));
if (isset($_POST['radio'])) $radio_id = intval(getpost('radio'));
if (isset($_POST['from'])) { $from1 = getpost('from'); $from = date('Y-m-d',strtotime($from1)); }
if (isset($_POST['until'])) { $until2 = getpost('until'); $until = date('Y-m-d',strtotime($until2)); }
$old = date('Y-m-d',strtotime("2000/01/01"));
?>

    <div class="content container">
        <div class="row">

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
			
			

		<?php if ($singer_id>0) { ?>
		
		<?php
			$title = "";
			$extraSql = " a.id = '".$singer_id."' ";
			if ($radio_id > 0 ){
				$extraSql .= " and pm.radio_id = '".$radio_id."' ";
				//$title .= $radio_names[$radio_id]."</br>";
			}
			if ($from > $old ){
				$extraSql .= " and pm.date_played >= '".$from."'";
				$title .= "Бул күндөн баштап: ".$from1."</br>";
			}
			if ($until > $old ){
				$extraSql .= " and pm.date_played <= '".$until."'";
				$title .= "Бул күнгө чейин: ".$until2."</br>";
			}
			
			if ($from < $old && $until < $old){
				$title = "Эң башынан бүгүнкүгө чейин";
			}
			 
		
			$today_radios_sql = "select pm.*, m.song from played_melody pm 
								  inner join melody m on m.track_id=pm.track_id 
								  inner join artist_melody am ON m.id = am.melody_id
								  inner join artist a ON a.id = am.artist_id
								  where ".$extraSql."
								  ORDER BY pm.radio_id, pm.date_played desc, pm.time_played desc";
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
                    <h4 class="card-title center-align"><?php echo $title;?></h4>

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
                                        <?php 
										foreach ($radio as $radio_item) { 
											
										?>
											
                                            <li class="collection-item">
                                                <?php echo $radio_item['song']; ?>
                                                <h6>
                                                    
                                                    <span>
                                                        <i class="mdi-action-schedule"></i>
														<?php echo date('d.m.Y',strtotime($radio_item['date_played'])); ?> <?php echo date('H:i',strtotime($radio_item['time_played'])); ?>
                                                        
                                                    </span>
                                                </h6>
                                            </li>
                                        <?php 
										} ?>
                                    </ul>

                                </div>
                            </li>
                            <?php 
							
							}} else { ?>
							<li> <div class="collapsible-header">Бул убакытта радиодон ырыңыз кетпептир</div></li>
							<?php } ?>
                        </ul>

                    </div>

                </div>

            </div>


        </div>
			<?php } ?>
			

        </div>
    </div>

<?php include('footer.php'); ?>