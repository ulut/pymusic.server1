<?php
include('config.php');
if (isset($_GET['time'])){
	$time = getget('time');
	$dateStart = $time;
	$dateLast = strtotime('+7 days', $time);
	$last_week_leader_song = apc_fetch('leader_singer_'.$time);
} else {
	$last_monday = strtotime('last Monday', strtotime('tomorrow'));
	$weekday = date('w');
	if ($weekday==0 || $weekday>2) {
		$dateLast = $last_monday;
		$dateStart = strtotime('-7 days', $dateLast);
		
	} else {
		$dateLast = strtotime('-7 days', $last_monday);
		$dateStart = strtotime('-7 days', $dateLast);
	}
	$last_week_leader_song = apc_fetch('leader_singer_'.$dateStart);
}
//date('d.m.Y', $last_monday)." ".date('d.m.Y', $dateStart)." ".date('d.m.Y', $dateLast)
if (!$last_week_leader_song) die("");

//print_r($last_week_leader_song);
	
//setlocale(LC_TIME, 'ru_RU.UTF-8', setlocale(LC_TIME, '0'));
setlocale(LC_TIME, 'ru_RU.utf8');
//setlocale(LC_ALL, 'ru_RU.UTF-8');
//var_dump(setlocale(LC_ALL, 'ru_RU.utf8'));
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

    <title>ТМС кабарлайт:  <?php echo date("d.m.Y", $dateStart); ?> - <?php echo date("d.m.Y", $dateLast); ?> күндөрү арасындагы радиолордо эң көп берилген 50 аткаруучу.</title>

    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="css/font-awesome.css"  media="screen,projection"/>
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>

<div class="header white z-depth-1">
    <div class="container">
        <div class="row">
            <nav>

                <div class="nav-wrapper">
                    <a href="/index.php" class="brand-logo center">
                        <img src="images/logo_red_on_white.png" alt=""/>
                    </a>
                    
                </div>

            </nav>
        </div>
    </div>
</div>


<div class="content">

<!--    SONGS ROW-->

	<div class="row">
	

			ТМС кабарлайт:  <?php echo date("d.m.Y", $dateStart); ?> - <?php echo date("d.m.Y", $dateLast); ?> күндөрү арасындагы радиолордо эң көп берилген 50 аткаруучу.<br>
		
	</div>

    <div class="row">

<!--    songs yesterday row-->

        <div>
            <div class="card white z-depth-2 songs-list">
                <div class="card-content white-text">
                    <h4 class="card-title center-align">
                        <?php echo date("d.m.Y", $dateStart); ?> - <?php echo date("d.m.Y", $dateLast); ?>
                    </h4>
				
                    <div class="card-panel">

                        <ul class="collection">

                            <?php
                            $counter=1;
                            $last_id = 0;
                            foreach($last_week_leader_song as $key=>$singer) {
                                
                                ?>

                                <li class="collection-item" <?php if ($counter % 2) { ?>style="background:#FFFBD0"<?php } ?>>
                                    <p class="place"><?php echo $singer['real_counter']; ?></p>
                                    <?php if ($singer['movement']>15) { ?>
                                        <span class="badge left movement move-higher">+<?php echo $singer['movement']; ?><i class="fa fa-rocket"></i></span>
                                    <?php } else if ($singer['movement']==0.5) { ?>
                                        <span class="badge left movement move-new">NEW<i class="fa fa-star"></i></span>
                                    <?php } else if ($singer['movement']>0) { ?>
                                        <span class="badge left movement move-up">+<?php echo $singer['movement']; ?><i class="fa fa-arrow-up"></i></span>
                                    <?php } else if ($singer['movement']<0) { ?>
                                        <span class="badge left movement move-down"><?php echo $singer['movement']; ?><i class="fa fa-arrow-down"></i></span>
                                    <?php } else { ?>
                                        <span class="badge left movement move-no">=<i class="fa fa-circle-o"></i></span>
                                    <?php } ?>
                                    <h5 id="singer<?php echo $singer['artist_id'];?>"><?php echo $singer['artist'];?></h5>
                                </li>

                                <?php
                                $counter++; 
								if ($counter==51) break;
								} ?>
                        </ul>

                    </div>

                </div>

            </div>


        </div>       

    </div>

</div>
<div style="max-width:300px">	
			<div>Тизмеге жаңыдан же кайрадан кирди <span class="badge left movement move-new">NEW<i class="fa fa-star"></i></span></div>
			<div>Жогору карай көтөрүлдү <span class="badge left movement move-up">+<?php echo $singer['movement']; ?><i class="fa fa-arrow-up"></i></span></div>
			<div>Ракета, жогору карай көп баскычка көтөрүлдү<span class="badge left movement move-higher">+<i class="fa fa-rocket"></i></span></div>
			<div>Төмөндөдү<span class="badge left movement move-down">-<i class="fa fa-arrow-down"></i></span></div>
			<div>Өткөн жумадагы ордун сактап калды<span class="badge left movement move-no">=<i class="fa fa-circle-o"></i></span></div>
			

	</div>

<?php include("ga.php") ?>

</body>
</html>